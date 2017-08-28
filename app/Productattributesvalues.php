<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productattributesvalues extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','product_id','attribute_value_id','attribute_id'];
	protected $table = 'product_attributes_values';
    
	
	public function product() {
        return $this->belongsTo('App\Product','product_id');
    }
	


   

    

    

}
