<?php

namespace App\Models\Auth;

use App\Models\Traits\Uuid;
use Altek\Eventually\Eventually;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Altek\Accountant\Contracts\Recordable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\Models\Auth\Traits\SendUserPasswordReset;
use Altek\Accountant\Recordable as RecordableTrait;
use App\Models\Subscription\Traits\HasSubscriptions;
use App\Models\Traits\MediaLibray;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User.
 */
abstract class BaseUser extends Authenticatable implements Recordable, HasMedia
{
    use HasRoles,
        Eventually,
        Impersonate,
        Notifiable,
        RecordableTrait,
        SendUserPasswordReset,
        SoftDeletes,
        Uuid,
        HasApiTokens,
        HasSubscriptions,
        HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */
    protected $appends = [
        'full_name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'confirmed' => 'boolean',
        'to_be_logged_out' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'last_login_at',
        'password_changed_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Return true or false if the user can impersonate an other user.
     *
     * @param void
     * @return  bool
     */
    public function canImpersonate()
    {
        return $this->isAdmin();
    }

    /**
     * Return true or false if the user can be impersonate.
     *
     * @param void
     * @return  bool
     */
    public function canBeImpersonated()
    {
        return $this->id !== 1;
    }
}
