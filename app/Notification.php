<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Authenticatable
{
    use SoftDeletes;

    const ROLE_ADMIN = 1;
    const ROLE_MEMBER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NotificationId', 'UserId', 'NotificationText', 'IsRead', 'CreatedOn', 'ModifiedOn'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   

    


}
