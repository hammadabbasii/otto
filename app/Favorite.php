<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Favorite extends Authenticatable {

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'product_id'];


}
