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
        , 'delivery_days', 'quantity', 'tax', 'courier', 'shipping_cost', 'return_policy','category_id']);


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
        , 'delivery_days', 'quantity', 'tax', 'courier', 'shipping_cost', 'return_policy','category_id']);


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
        , 'delivery_days', 'quantity', 'tax', 'courier', 'shipping_cost', 'return_policy','category_id']);


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
	 
	 
	 public function getProductByBrand(Request $request,$brandId)
     {
        header('Content-type: application/json');

        if(!isset($brandId) || trim($brandId)=='' || trim($brandId)==0)
        {
			$obj = (object) array();
			return RESTAPIHelper::response($obj,'Error', 'Please Enter Product Id');
            /*$response=array("Response"=>"Error","Message"=>'Please Enter Product Id',"Result"=>array());
            echo json_encode($response);die();*/
        }
        $allProductsFromDB = DB::table('products')->where('brand_id', $brandId)->get(['id','brand_id', 'product_name', 'product_description', 'product_image', 'price'
        , 'delivery_days', 'quantity', 'tax', 'courier', 'shipping_cost', 'return_policy','category_id']);


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





}
