<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usernotification extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','order_id','user_id','notification_text','order_status'];
	protected $table = 'notifications';
    
   public function user() {
        return $this->belongsTo('App\User','user_id');
    }
	
	public function order() {
        return $this->belongsTo('App\Userorder','order_id');
    }
	

    

    

}
