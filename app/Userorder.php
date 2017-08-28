<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Userorder extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','items_ids','quantitites','user_id','amount','shipped_to_address'];
	protected $table = 'userorders';
    
    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
	public function items() {
        return $this->hasMany('App\Orderitem','order_id');
    }
	
	public function creator() {
        return $this->belongsTo('App\User','user_id');
    }
	
	public function address() {
        return $this->belongsTo('App\Useraddress','address_id');
    }
	

    

    

}
