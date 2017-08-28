<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name','image','parent_id'
    ];

    protected $appends = [
         'pro'
    ];
    
	
	public function subcategories() {
        return $this->hasMany('App\Category','parent_id');
    }
	
	public function parentcategory() {
        return $this->belongsTo('App\Category','parent_id');
    }
    public function product() {


        return $this->hasMany('App\Product','category_id');
    }

    public function brands(){
        return $this->hasMany('App\Brands','category_id');
    }

    public function getProductsByBrand(){
        /* SELECT * FROM products WHERE brand_id IN (SELECT id FROM brands WHERE category_id =2)*/
        // $this->hasManyThrough(Target Model, Related By Model, Related Foreign Key, Target Foreign Key, Primary Key);
        return $this->hasManyThrough('App\Product','App\Brands', 'category_id','brand_id', 'id');
    }
    public function getBrandsByBrand(){
        /* SELECT * FROM products WHERE brand_id IN (SELECT id FROM brands WHERE category_id =2)*/
        // $this->hasManyThrough(Target Model, Related By Model, Related Foreign Key, Target Foreign Key, Primary Key);
        return $this->hasManyThrough('App\Product','App\Brands', 'category_id','brand_id', 'id');
    }

//    public function getProAttribute()
//    {
//        return $this->subcategories->id;
//
//    }


}
