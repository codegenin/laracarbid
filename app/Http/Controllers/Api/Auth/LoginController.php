<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exceptions\GeneralException;
use App\Events\Api\Auth\UserLoggedIn;
use App\Events\Api\Auth\UserLoggedOut;
use App\Exceptions\ApiResponseException;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Api\BaseResponseController;

/**
 * Class LoginController.
 */
class LoginController extends BaseResponseController
{
    use AuthenticatesUsers;
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return config('access.users.username');
    }

    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user());
    }

    public function authenticate(LoginRequest $request)
    {
        // To many login attempts error
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return response()->json([
                'status'  => false,
                'message' => 'Too many login attempts, please try again in 1 hour.'
            ], 401);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param         $user
     *
     * @throws GeneralException
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Check to see if the user account is confirmed and active
        if (!$user->isConfirmed()) {
            // If the user is pending (account approval is on)
            if ($user->isPending()) {
                throw new ApiResponseException(__('exceptions.Api.auth.confirmation.pending'), 403);
            }
            // Otherwise see if they want to resent the confirmation e-mail
            throw new ApiResponseException(__('exceptions.Api.auth.confirmation.resend', ['url' => route('Api.auth.account.confirm.resend', e($user->{$user->getUuidName()}))]), 403);
        }

        // Check tp see if the user account is active
        if (!$user->isActive()) {
            throw new ApiResponseException(__('exceptions.Api.auth.deactivated'), 403);
        }

        // Everything ok, process the user token
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        // Fire vent, Log in user
        event(new UserLoggedIn($user));

        return $this->responseWithSuccess(__('auth.login_successful'), [
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Laravel specific logic
        $request->user()->token()->revoke(); // Revoke token
        $request->user()->token()->delete(); // Delete token, just in case cant be revoke

        // Fire event, Log out user
        event(new UserLoggedOut($request->user()));

        return $this->responseWithSuccess(__('auth.logout_successful'));
    }
}
