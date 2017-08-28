<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Favorite;
use App\Usercart;

class Product extends Authenticatable
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id','product_name','product_description','product_image','price','quantity','product_image','category_id'
    ];

    protected $appends = ['is_in_wishlist'];

    public function quantityproduct() {
        return $this->hasMany('App\Usercart','product_id');
    }
    public function getIsInWishlistAttribute()
    {

        $is_in_wishlist = 0;
        $user = session()->get('user');
        if ($user)
        {
                $productId = $this->id;
                $userId    = $user->id;
                $favInfo = Favorite::where('user_id',$userId)->where('product_id',$productId)->first();
                if($favInfo) {  $is_in_wishlist = 1;  }
        }
        return  $is_in_wishlist;


}

    





}
