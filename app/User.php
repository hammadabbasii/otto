<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {

    use SoftDeletes;

    const ROLE_ADMIN = 1;
    const ROLE_MEMBER = 2;
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 0;
    const DEVICE_TYPE_WEB = 'web';
    const SOCIALMEDIA_PLATFORM_FB = 'fb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'user_name', 'full_name', 'first_name', 'last_name', 'dob', 'image', 'email', 'password', 'address', 'gender', 'city', 'state', 'country', 'postal_code', 'phone_number', 'company_name', 'profile_picture', 'is_purchased', 'product_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin() {
        return (bool) (intval($this->attributes['role_id']) === self::ROLE_ADMIN);
    }

}
