<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Repositories\Api\Auth\UserRepository;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Controllers\Api\BaseResponseController;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\Auth\VerifyPasswordToken;

/**
 * Class ResetPasswordController.
 */
class ResetPasswordController extends BaseResponseController
{
    use ResetsPasswords;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ChangePasswordController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Verify the password reset for the given token.
     *
     * @param string|null $token
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyResetToken(VerifyPasswordToken $request)
    {
        if (!$request->token) {
            return $this->responseWithSuccess(__('auth.password.token_problem'));
        }

        $user = $this->userRepository->findByPasswordResetToken($request->token);

        if ($user && resolve('auth.password.broker')->tokenExists($user, $request->token)) {
            return $this->responseWithSuccess(__('auth.password.valid_token'));
        }

        return $this->responseWithError(__('auth.password.token_problem'));
    }

    /**
     * Reset the given user's password.
     *
     * @param  ResetPasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(ResetPasswordRequest $request)
    {
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $this->responseWithError(__('auth.password.reset_successful'));
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     */
    protected function resetPassword($user, $password)
    {
        $user->password = $password;

        $user->password_changed_at = now();

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }
}
