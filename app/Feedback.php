<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'feedback';
    protected $fillable = ['id','feedback_message','user_id','enquiry_type','name','email','phone','product_name','store_locations','message','address'];

   public function user() {
        return $this->belongsTo('App\User','user_id');
    }
	
	
    

    

}
