<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Config;

class Ad extends Authenticatable {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'category_id', 'title', 'description', 'phone_number', 'price', 'year', 'is_featured'
    ];
    protected $appends = ['ad_image'];

    public function adimages() {
        return $this->hasMany('App\Adimage', 'ad_id');
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function imagesToArray() {
        $arr = [];

        foreach ($this->adimages as $image) {

            $arr[] = asset('public/' . Config::get('constants.front.dir.adsPicPath') . ($image->image ?: Config::get('constants.front.default.profilePic')));
        }

        return $arr;
    }

    public function getAdImageAttribute() {
        return $this->imagesToArray();
    }

}
