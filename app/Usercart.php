<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usercart extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','product_id','quantity'];
	protected $table = 'usercart';
    
   public function user() {
        return $this->belongsTo('App\User','user_id');
    }
	public function product() {
        return $this->belongsTo('App\Product','product_id');
    }

    

    

}
