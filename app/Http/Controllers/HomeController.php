<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Config;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use App\Cms;
use App\Category;
use App\Favorite;
use App\Ad;
use App\Helpers\RESTAPIHelper;
use Validator;
use Session;

class HomeController extends Controller {

    public function getIndex(Request $request) {
        $featureAds = Ad::where('is_featured', 1)->with('adimages')->limit(5)->get();

        return frontend_view('index', compact('featureAds'));
    }

    public function logout(Request $request) {
//      dd(Auth::user());
//        $user=$request->session()->get('user');
//        dd($user);
        // $_SESISON['my_name'] = 'sas';
        //   session(['aaa' => 'aaa']);
        // Session::set('variableName', 'sss');
        // session()->put('my_name','sasasas')
//       print_r(session::all());
        //$allCategoriesFromDB = Category::with('subcategories')->get();
        Session::forget('user');
        Session::flush();
        return redirect('index');

        $featureAds = Ad::where('is_featured', 1)->with('adimages')->limit(5)->get();
//       dd($allCategoriesFromDB);
        return frontend_view('index', compact('featureAds'));
    }

    public function getlogin(Request $request) {
        if ($request->session()->get('user')) {
            return redirect('index');
        }
        return frontend_view('login');
    }

    public function forgotpwd() {
        return frontend_view('forgot');
    }

    public function signup(Request $request) {
        if ($request->session()->get('user')) {
            return redirect('index');
        }
        return frontend_view('account');
    }

    public function category($category) {
        $allAddFromDb = Ad::where('category_id', 1)->with('adimages', 'user')->get();
        return frontend_view('categories', compact('allAddFromDb'));
    }

    public function contactus() {
        return frontend_view('contactus');
    }

    public function productdetail(Request $request, $category, $product) {
        $product = Product::where('id', $product)->first();
        $category = Category::where('id', $category)->first();
        return frontend_view('productdetail', compact('product', 'category'));
    }

    public function addToFavorite(Request $request, $product) {

        $user = $request->session()->get('user');
        //dd($product);
        $isFav = $user->favoriteProducts()->where('product_id', $product)->where('user_id', $user->id)->first();
        $isFav = ($isFav) ? 1 : 0;
        // dd($isFav);
        if (!$isFav) {
            $NewArray['brand_id'] = 0;
            $NewArray['category_id'] = 0;
            $NewArray['sub_category_id'] = 0;
            $isFav = Favorite::create(['product_id' => $product, 'user_id' => $user->id, 'brand_id' => 0, 'category_id' => 0, 'sub_category_id' => 0]);
        }
//        else
//        {
//            //dd("");
//              //$check=Favorite::where('product_id', $product)->delete();
//            //dd($product);
//            $check= Favorite::where('product_id', $product)->delete();
//        }
//        $product=Product::where('id',$product)->first();
////        dd($product);
//        $category=Category::where('id',$category)->first();
        header('Content-type: application/json');
        return ['success' => $isFav];

        //return frontend_view('productdetail',compact('product','category','isFav'));
    }

//    public function productlist($category) {
//        $Category = Category::whereId($category)->with('brands')->first();
//        $allCategoriesFromDB = Category::where('parent_id', 0)->whereId($Category->parent_id)->with('subcategories')->first();
//        return frontend_view('productlist', compact('allCategoriesFromDB', 'Category')); //
//    }

    public function termsandconditions() {
        $cms = Cms::where('key', 'terms')->first();

        return frontend_view('termsandcondition', compact('cms'));
    }

    public function aboutus() {
        $cms = Cms::where('key', 'aboutus')->first();
        return frontend_view('aboutus', compact('cms'));
    }

    public function privacy() {
        $cms = Cms::where('key', 'policies')->first();
        return frontend_view('privacypolicy', compact('cms'));
    }

    public function help() {
        $cms = Cms::where('key', 'help')->first();
        return frontend_view('help', compact('cms'));
    }

    public function orders() {
        $user = session()->get('user');
        $usercart = Usercart::where('user_id', $user->id)->get();
        /* for($i=0;$i<count($usercart);$i++) {
          $data[]=$usercart[$i]->product_id;
          }
          foreach($data as $product_id)
          {
          $product[]=Product::where('id',$product_id)->with('quantityproduct')->get();
          } */
        return frontend_view('orders', compact('usercart'));
    }

    public function wishlist() {
        $user = Session::get('user');
        $product = [];
        $data = [];
        //dd($user->id);
        $favorite = Favorite::where('user_id', $user->id)->get();
        for ($i = 0; $i < count($favorite); $i++) {
            $data[] = $favorite[$i]->product_id;
        }
        if ($data) {
//           dd('if');
            //dd($data);
            foreach ($data as $product_id) {
//            echo $product_id;
                $product[] = Product::where('id', $product_id)->get();
            }

            return frontend_view('wishlist', compact('product'));
        } else {
//            dd('else');
            return frontend_view('wishlist', compact('product'));
        }
    }

    public function categories() {
        $allCategoriesFromDB = Category::where('parent_id', 0)->with('subcategories')->get();
//        dd($allCategoriesFromDB);
        return frontend_view('all_categories', compact('allCategoriesFromDB'));
    }

    public function checkOut() {
        $user = session()->get('user');
        $usercart = Usercart::where('user_id', $user->id)->get();
        $useraddress = Useraddress::where('user_id', $user->id)->get();
        //dd($useraddress);
        return frontend_view('checkout', compact('usercart', 'useraddress'));
    }

    public function addAddress() {
        $user = session()->get('user');
        return frontend_view('addaddress');
    }

}
