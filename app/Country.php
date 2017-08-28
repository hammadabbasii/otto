<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Authenticatable
{

   
    
   public function cities() {
        return $this->hasMany('App\City','countryID');
    }
	
	
    

    

}
