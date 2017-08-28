<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Itinerary extends Authenticatable {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'itinerary_name','status'];

}
