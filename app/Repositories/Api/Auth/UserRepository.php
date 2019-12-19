<?php

namespace App\Repositories\Api\Auth;

use App\Models\Auth\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Events\Api\Auth\UserConfirmed;
use App\Exceptions\ApiResponseException;
use App\Notifications\Api\Auth\UserNeedsConfirmation;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     *
     * @param  User  $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param $token
     *
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function findByPasswordResetToken($token)
    {
        foreach (DB::table(config('auth.passwords.users.table'))->get() as $row) {
            if (password_verify($token, $row->token)) {
                return $this->getByColumn($row->email, 'email');
            }
        }

        return false;
    }

    /**
     * @param $uuid
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findBymobile($mobile)
    {
        $user = $this->model->whereHas('profile', function ($query) use ($mobile) {
            $query->where('mobile', $mobile);
        })
            ->first();

        if ($user instanceof $this->model) {
            return $user;
        }

        throw new ApiResponseException(__('exceptions.api.access.users.not_found'), 404);
    }

    /**
     * @param $uuid
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findByUuid($uuid)
    {
        $user = $this->model
            ->uuid($uuid)
            ->first();

        if ($user instanceof $this->model) {
            return $user;
        }

        throw new ApiResponseException(__('exceptions.api.access.users.not_found'), 404);
    }

    /**
     * @param $code
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findByConfirmationCode($code)
    {
        $user = $this->model
            ->where('confirmation_code', $code)
            ->where('confirmed', 0)
            ->first();

        if ($user instanceof $this->model) {
            return $user;
        }

        throw new ApiResponseException(__('exceptions.api.access.users.not_found'), 404);
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = $this->model::create([
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'email'             => $data['email'],
                'confirmation_code' => sms_confirmation_code(),
                'active'            => true,
                'password'          => $data['password'],
                // If users require approval or needs to confirm email
                'confirmed' => !(config('access.users.requires_approval') || config('access.users.confirm_mobile')),
            ]);

            // Create user profile
            $user->profile()->create([
                'business_name'  => $data['business_name'],
                'license_number' => $data['license_number'],
                'dealer_bond'    => $data['dealer_bond'],
                'dealer_type'    => $data['dealer_type'],
                'zipcode'        => $data['zipcode'],
                'mobile'         => $data['mobile']
            ]);

            if ($user) {
                // Add the default site role to the new user
                $user->assignRole(config('access.users.default_role'));
            }

            /*
             * If users have to confirm their email/mobile and this is not a social account,
             * and the account does not require admin approval
             * send the confirmation email/sms
             *
             * If this is a social account they are confirmed through the social provider by default
             */
            if (config('access.users.confirm_mobile')) {
                // Pretty much only if account approval is off, confirm email is on or confirm mobile is on, and this isn't a social account.
                $user->notify(new UserNeedsConfirmation($user->confirmation_code));
            }

            // Return the user object
            return $user;
        });
    }

    /**
     * @param       $id
     * @param array $input
     * @param bool|UploadedFile  $image
     *
     * @throws GeneralException
     * @return array|bool
     */
    public function update($id, array $input, $image = false)
    {
        $user = $this->getById($id);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->avatar_type = $input['avatar_type'];

        // Upload profile image if necessary
        if ($image) {
            $user->avatar_location = $image->store('/avatars', 'public');
        } else {
            // No image being passed
            if ($input['avatar_type'] === 'storage') {
                // If there is no existing image
                if (auth()->user()->avatar_location === '') {
                    throw new GeneralException('You must supply a profile image.');
                }
            } else {
                // If there is a current image, and they are not using it anymore, get rid of it
                if (auth()->user()->avatar_location !== '') {
                    Storage::disk('public')->delete(auth()->user()->avatar_location);
                }

                $user->avatar_location = null;
            }
        }

        if ($user->canChangeEmail()) {
            //Address is not current address so they need to reconfirm
            if ($user->email !== $input['email']) {
                //Emails have to be unique
                if ($this->getByColumn($input['email'], 'email')) {
                    throw new GeneralException(__('exceptions.frontend.auth.email_taken'));
                }

                // Force the user to re-verify his email address if config is set
                if (config('access.users.confirm_email')) {
                    $user->confirmation_code = md5(uniqid(mt_rand(), true));
                    $user->confirmed = false;
                    $user->notify(new UserNeedsConfirmation($user->confirmation_code));
                }
                $user->email = $input['email'];
                $updated = $user->save();

                // Send the new confirmation e-mail

                return [
                    'success' => $updated,
                    'email_changed' => true,
                ];
            }
        }

        return $user->save();
    }

    /**
     * @param      $input
     * @param bool $expired
     *
     * @throws GeneralException
     * @return bool
     */
    public function updatePassword($input, $expired = false)
    {
        $user = $this->getById(auth()->id());

        if (Hash::check($input['old_password'], $user->password)) {
            if ($expired) {
                $user->password_changed_at = now()->toDateTimeString();
            }

            return $user->update(['password' => $input['password']]);
        }

        throw new GeneralException(__('exceptions.frontend.auth.password.change_mismatch'));
    }

    /**
     * @param mixed $locale
     */
    public function updateLocale($locale)
    {
        $user = $this->getById(auth()->id());

        return $user->update(['locale' => $locale]);
    }

    /**
     * @param $code
     *
     * @throws GeneralException
     * @return bool
     */
    public function confirm($code)
    {
        $user = $this->findByConfirmationCode($code);

        if ($user->confirmed === true) {
            throw new ApiResponseException(__('exceptions.api.auth.confirmation.already_confirmed'), 400);
        }

        if ($user->confirmation_code === $code) {
            $user->confirmed = true;

            event(new UserConfirmed($user));
            $user->save();
            return $user;
        }

        throw new ApiResponseException(__('exceptions.api.auth.confirmation.mismatch'), 400);
    }

    /**
     * @param $fullName
     *
     * @return array
     */
    protected function getNameParts($fullName)
    {
        $parts = array_values(array_filter(explode(' ', $fullName)));
        $size = count($parts);
        $result = [];

        if (empty($parts)) {
            $result['first_name'] = null;
            $result['last_name'] = null;
        }

        if (!empty($parts) && $size === 1) {
            $result['first_name'] = $parts[0];
            $result['last_name'] = null;
        }

        if (!empty($parts) && $size >= 2) {
            $result['first_name'] = $parts[0];
            $result['last_name'] = $parts[1];
        }

        return $result;
    }
}
