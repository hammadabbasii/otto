<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Hash;
use Config;

use Gregwar\Image\Image;
use JWTAuth;

use App\Setting;
use App\User;
use App\Report;
use App\Product;
use App\Http\Requests\Frontend\UserRegisterRequest;
use App\Http\Requests\Frontend\EditProfileRequest;
use App\Helpers\RESTAPIHelper;

use Validator;
use App\Http\Requests\Frontend\UserRegisterRequest2;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class ProductController extends ApiBaseController {

    public function init()
    {
        return RESTAPIHelper::response([
            'tutorial_video' => Setting::extract('app.link.tutorial_video', ''),
        ]);
    }

    #Enlist all products
     public function getAllProducts(Request $request)
     {
        header('Content-type: application/json');

        $allProductsFromDB = DB::table('products')->get(['id', 'product_name', 'product_description', 'product_image', 'price'
        , 'delivery_days', 'quantity', 'tax','is_favorite', 'courier', 'shipping_cost', 'return_policy','category_id']);


        #Alternatively this can also be used; this is not standard
        #$allProductsFromDB = Product::all();

        $jsonArray=array();
        $responseArray=array();
        $allProducts=array();

        foreach($allProductsFromDB as $Product)
        {
            $thisProduct	=	array();
            $thisProduct	=	$Product;

            $allProducts[]	=	$thisProduct;
        }

        $jsonArray['Products']=$allProducts;
		return RESTAPIHelper::response($jsonArray,'Success', 'All User Product');
        /*$response=array("Response"=>"Success","Message"=>'All User Product',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }

     #Get a particular product
     public function getProduct(Request $request,$productId)
     {
        header('Content-type: application/json');

        if(!isset($productId) || trim($productId)=='' || trim($productId)==0)
        {
			$obj = (object) array();
            return RESTAPIHelper::response($obj,'Error', 'Please Enter Product Id');
			/*$response=array("Response"=>"Error","Message"=>'Please Enter Product Id',"Result"=>array());
            echo json_encode($response);die();*/
        }
        $allProductsFromDB = DB::table('products')->where('id', $productId)->get(['id', 'product_name', 'product_description', 'product_image', 'price'
        , 'delivery_days', 'quantity', 'tax','is_favorite', 'courier', 'shipping_cost', 'return_policy','category_id']);


        $jsonArray=array();
        $responseArray=array();
        $allProducts=array();

        foreach($allProductsFromDB as $Product)
        {
			$Product->product_images	=	array();
			$allproduct_images	=	array();
			$allproduct_imagesFromDB = DB::table('productimages')->where('id', $productId)->get([ 'product_image']);
			foreach($allproduct_imagesFromDB as $eachproduct_image)
			{
				$allproduct_images[]	=	$eachproduct_image->product_image;
			}
			$Product->product_images	=	$allproduct_images;
            $allProducts	=	$Product;
        }

        $jsonArray['Product']=$allProducts;
		return RESTAPIHelper::response($jsonArray,'Success', 'Product');
        /*$response=array("Response"=>"Success","Message"=>'Product',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }


     public function getProductByCategory(Request $request,$categoryId)
     {
        header('Content-type: application/json');

        if(!isset($categoryId) || trim($categoryId)=='' || trim($categoryId)==0)
        {
			$obj = (object) array();
			return RESTAPIHelper::response($obj,'Error', 'Please Enter Product Id');
            /*$response=array("Response"=>"Error","Message"=>'Please Enter Product Id',"Result"=>array());
            echo json_encode($response);die();*/
        }
        $allProductsFromDB = DB::table('products')->where('category_id', $categoryId)->get(['id', 'product_name', 'product_description', 'product_image', 'price'
        , 'delivery_days', 'quantity', 'tax', 'courier','is_favorite', 'shipping_cost', 'return_policy','category_id']);


        $jsonArray=array();
        $responseArray=array();
        $allProducts=array();

        foreach($allProductsFromDB as $Product)
        {
          $thisProduct	=	array();
          $thisProduct	=	$Product;

          $allProducts[]	=	$thisProduct;
        }

        $jsonArray['Products']=$allProducts;
		return RESTAPIHelper::response($jsonArray,'Success', 'Product');
        /*$response=array("Response"=>"Success","Message"=>'Product',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }
	 
	 
	 public function getProductByBrand(Request $request)
     {
		$input = $request->all();
        extract($input);
        header('Content-type: application/json');

        if(!isset($brandId) || trim($brandId)=='' || trim($brandId)==0)
        {
			$obj = (object) array();
			return RESTAPIHelper::response($obj,'Error', 'Please Enter Brand Id');
        }
		else if(!isset($user_id) || trim($user_id)=='')
        {
			$obj = (object) array();
			return RESTAPIHelper::response($obj,'Error', 'Please Enter user_id');
        }
        $allProductsFromDB = DB::table('products')->where('brand_id', $brandId)->get(['id','brand_id', 'product_name', 'product_description', 'product_image', 'price'
        , 'delivery_days', 'quantity', 'tax', 'courier','is_favorite', 'shipping_cost', 'return_policy','category_id']);
		$userFavorittedProducts	=	array();
		if($userFavorittedProducts>0)
		{
			$userFavorittedProducts	=	$this->getUserFavorittedIds($user_id);
		}
        $jsonArray=array();
        $responseArray=array();
        $allProducts=array();

        foreach($allProductsFromDB as $Product)
        {
          $thisProduct	=	array();
          $thisProduct	=	$Product;
		  $thisProductId	=	$Product->id;
		  if(in_array($thisProductId,$userFavorittedProducts))
		  {
			 $thisProduct->is_favorite 	=	'1';
		  }

          $allProducts[]	=	$thisProduct;
        }

        $jsonArray['Products']=$allProducts;
		return RESTAPIHelper::response($jsonArray,'Success', 'Product');
        /*$response=array("Response"=>"Success","Message"=>'Product',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }
	 
	 
	 public function searchProducts(Request $request)
     {
		$input = $request->all();
        extract($input);
		
        header('Content-type: application/json');

        if(!isset($keyword) || trim($keyword)=='' )
        {
			$obj = (object) array();
			return RESTAPIHelper::response($obj,'Error', 'Please Enter keyword');
        }
		else if(!isset($user_id) || trim($user_id)=='')
        {
			$obj = (object) array();
			return RESTAPIHelper::response($obj,'Error', 'Please Enter user_id');
        }
		
        $allProductsFromDB = DB::table('products')->where('product_name', 'like', "%$keyword%")->limit(100)->get(['id','brand_id', 'product_name', 'product_description', 'product_image', 'price'
, 'delivery_days', 'quantity', 'tax', 'courier','is_favorite', 'shipping_cost', 'return_policy','category_id']);

		$userFavorittedProducts	=	array();
		if($userFavorittedProducts>0)
		{
			$userFavorittedProducts	=	$this->getUserFavorittedIds($user_id);
		}
        $jsonArray=array();
        $responseArray=array();
        $allProducts=array();

        foreach($allProductsFromDB as $Product)
        {
          $thisProduct	=	array();
          $thisProduct	=	$Product;
		  $thisProductId	=	$Product->id;
		  if(in_array($thisProductId,$userFavorittedProducts))
		  {
			 $thisProduct->is_favorite 	=	'1';
		  }

          $allProducts[]	=	$thisProduct;
        }

        $jsonArray['Products']=$allProducts;
		return RESTAPIHelper::response($jsonArray,'Success', 'Product');
        /*$response=array("Response"=>"Success","Message"=>'Product',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }
	 
	 
	 public function getFavoriteProduct(Request $request)
     {
		$input = $request->all();
        extract($input);
        header('Content-type: application/json');
		$obj = (object) array();

        if(!isset($user_id) || trim($user_id)=='')
        {
			
			return RESTAPIHelper::response($obj,'Error', 'Please Enter user_id');
        }
		
		#Get User Favouritted Product IDs 
		$userFavorittedProducts	=	array();
		if($userFavorittedProducts>0)
		{
			$userFavorittedProducts	=	$this->getUserFavorittedIds($user_id);
		}
		
		if(empty($userFavorittedProducts))
		{
			return RESTAPIHelper::response($obj,'Error', 'No Products in Favorite ');	
		}
		
        $allProductsFromDB = DB::table('products')->whereIn('id', $userFavorittedProducts)->get(['id','brand_id', 'product_name', 'product_description', 'product_image', 'price'
        , 'delivery_days', 'quantity', 'tax', 'courier','is_favorite', 'shipping_cost', 'return_policy','category_id']);
		$userFavorittedProducts	=	array();
		if($userFavorittedProducts>0)
		{
			$userFavorittedProducts	=	$this->getUserFavorittedIds($user_id);
		}
        $jsonArray=array();
        $responseArray=array();
        $allProducts=array();

        foreach($allProductsFromDB as $Product)
        {
          $thisProduct	=	array();
          $thisProduct	=	$Product;
		  $thisProductId	=	$Product->id;
		  if(in_array($thisProductId,$userFavorittedProducts))
		  {
			 $thisProduct->is_favorite 	=	'1';
		  }

          $allProducts[]	=	$thisProduct;
        }

        $jsonArray['Products']=$allProducts;
		return RESTAPIHelper::response($jsonArray,'Success', 'Product');
        /*$response=array("Response"=>"Success","Message"=>'Product',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }
	 
	 
	 public function markFavorite(Request $request) {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

        header('Content-type: application/json');

        if (!isset($user_id) || trim($user_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter user_id');
        } elseif (!isset($product_id) || trim($product_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter product_id');
        } 



        $favouriteRecord = DB::table('favorites')->where('user_id', $user_id)->where('product_id', $product_id)->get();

        if (!empty($favouriteRecord)) 
		{
			DB::table('favorites')->where('user_id', $user_id)->where('product_id', $product_id)->delete();
			return RESTAPIHelper::response(((object) array()), 'Success', 'Product Unfavoruitted successfully');
		} 
		else 
		{
			$NewArray = array();
            $NewArray['user_id'] = $user_id;
            $NewArray['product_id'] = $product_id;
            $NewArray['brand_id'] = 0;
            $NewArray['category_id'] = 0;
            $NewArray['sub_category_id'] = 0;

            $favoriteId = DB::table('favorites')->insertGetId($NewArray);
			
            return RESTAPIHelper::response(((object) array()), 'Success', 'Product Favourited Successfully');
        }
    }
	
	 
	 public function unmarkFavorite(Request $request) {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

        header('Content-type: application/json');

        if (!isset($user_id) || trim($user_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter user_id');
        } elseif (!isset($product_id) || trim($product_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter product_id');
        } 



        $favouriteRecord = DB::table('favorites')->where('user_id', $user_id)->where('product_id', $product_id)->get();

        if (!empty($favouriteRecord)) 
		{
			DB::table('favorites')->where('user_id', $user_id)->where('product_id', $product_id)->delete();
			return RESTAPIHelper::response(((object) array()), 'Success', 'Product Unfavoruitted successfully');
			
		} 
		else 
		{
			return RESTAPIHelper::response(((object) array()), 'Error', 'You have not favoutritted this product yer');
        }
    }



    public function markFavoriteWeb(Request $request) {
        $input = $request->all();
        extract($input);
        $is_favourite = 0;
        $responseArray = array();

        if (!isset($user_id) || trim($user_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter user_id');
        } elseif (!isset($product_id) || trim($product_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter product_id');
        }

        $favouriteRecord = DB::table('favorites')->where('user_id', $user_id)->where('product_id', $product_id)->get();

        if (!empty($favouriteRecord))
        {
            DB::table('favorites')->where('user_id', $user_id)->where('product_id', $product_id)->delete();

            $is_favourite = 0 ; // using in website
            $responseArray['status'] = $is_favourite;

            return RESTAPIHelper::response($responseArray, 'Success', 'Product Unfavoruitted successfully');

        }
        else
        {
            $NewArray = array();
            $NewArray['user_id'] = $user_id;
            $NewArray['product_id'] = $product_id;
            $NewArray['brand_id'] = 0;
            $NewArray['category_id'] = 0;
            $NewArray['sub_category_id'] = 0;

            $favoriteId = DB::table('favorites')->insertGetId($NewArray);
            $is_favourite = 1 ; // using in website

            $responseArray['status'] = $is_favourite;
            return RESTAPIHelper::response($responseArray, 'Success', 'Product Favourited Successfully');
        }
    }

	public function getUserFavorittedIds($userId=97)
	{
		$allUserFavoritesIds	=	array();
		$allUserFavorites = DB::table('favorites')->where('user_id', $userId)->get();	
		if(!empty($allUserFavorites))
		{
			foreach($allUserFavorites as $eachUserFav)
			{
				$allUserFavoritesIds[]	=	$eachUserFav->product_id	;
			}	
			
		}
		return $allUserFavoritesIds;
	}
	
	



}
