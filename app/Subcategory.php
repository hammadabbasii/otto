<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'categories';
    protected $fillable = [
        'category_name','image','parent_id'
    ];



    public function product() {
        return $this->hasMany('App\Product','category_id');
    }

}
