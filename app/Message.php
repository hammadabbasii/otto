<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Message extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','sender_id','trip_id','message_text','receiver_id'];
    
   

    public function user() {
        return $this->belongsTo('App\User','sender_id');
    }
    
    public function trip() {
        return $this->belongsTo('App\Trip','trip_id');
    }

    

}
