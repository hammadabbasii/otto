<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Useraddress extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','country_id','country','city_id','city','street_name','building_name','floor','appartment','nearest_landmark','location_type'];
	protected $table = 'user_address';
    
   public function user() {
        return $this->belongsTo('App\User','user_id');
    }
	

    

    

}
