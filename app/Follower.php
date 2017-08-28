<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Follower extends Authenticatable {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'follower_id', 'following_id'];

    public function user() {
        return $this->belongsTo('App\User','follower_id');
    }
	public function user2() {
        return $this->belongsTo('App\User','following_id');
    }

}
