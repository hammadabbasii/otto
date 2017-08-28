<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orderitem extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','order_id','product_id','price','quantity','created_at','updated_at'];
	protected $table = 'orderitems';
    
    public function order() {
        return $this->belongsTo('App\User','order_id');
    }
	
    

    

}
