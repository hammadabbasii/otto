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

        $allProductsFromDB = DB::table('products')->get(['ProductId', 'ProductName', 'ProductDescription', 'ProductImage', 'Price'
        , 'DeliveryDays', 'Quantity', 'Tax', 'AvailableSizes', 'AvailableSizesNames', 'Courier', 'ShippingCost', 'ReturnPolicy','CategoryId']);


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

        $response=array("Response"=>"Success","Message"=>'All User Product',"Result"=>$jsonArray);
        echo json_encode($response);die();
     }

     #Get a particular product
     public function getProduct(Request $request,$productId)
     {
        header('Content-type: application/json');

        if(!isset($productId) || trim($productId)=='' || trim($productId)==0)
        {
            $response=array("Response"=>"Error","Message"=>'Please Enter Product Id',"Result"=>array());
            echo json_encode($response);die();
        }
        $allProductsFromDB = DB::table('products')->where('ProductId', $productId)->get(['ProductId', 'ProductName', 'ProductDescription', 'ProductImage', 'Price'
        , 'DeliveryDays', 'Quantity', 'Tax', 'AvailableSizes', 'AvailableSizesNames', 'Courier', 'ShippingCost', 'ReturnPolicy','CategoryId']);


        $jsonArray=array();
        $responseArray=array();
        $allProducts=array();

        foreach($allProductsFromDB as $Product)
        {
            $allProducts	=	$Product;
        }

        $jsonArray['Product']=$allProducts;

        $response=array("Response"=>"Success","Message"=>'Product',"Result"=>$jsonArray);
        echo json_encode($response);die();
     }


     public function getProductByCategory(Request $request,$categoryId)
     {
        header('Content-type: application/json');

        if(!isset($categoryId) || trim($categoryId)=='' || trim($categoryId)==0)
        {
            $response=array("Response"=>"Error","Message"=>'Please Enter Product Id',"Result"=>array());
            echo json_encode($response);die();
        }
        $allProductsFromDB = DB::table('products')->where('CategoryId', $categoryId)->get(['ProductId', 'ProductName', 'ProductDescription', 'ProductImage', 'Price'
        , 'DeliveryDays', 'Quantity', 'Tax', 'AvailableSizes', 'AvailableSizesNames', 'Courier', 'ShippingCost', 'ReturnPolicy','CategoryId']);


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

        $response=array("Response"=>"Success","Message"=>'Product',"Result"=>$jsonArray);
        echo json_encode($response);die();
     }

     //User Specific Product, list all Notis of Specific User; All whether read or unread
     public function getUserProducts(Request $request,$userId)
     {

        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
            $response=array("Response"=>"Error","Message"=>'Please Enter User Id',"Result"=>array());
            echo json_encode($response);die();
        }

        $allProductsFromDB = DB::table('products')->where('UserId', $userId)->get();

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

        $response=array("Response"=>"Success","Message"=>'All User Product',"Result"=>$jsonArray);
        echo json_encode($response);die();
     }

     #Read Products of Specific user
     public function getReadUserProducts(Request $request,$userId)
     {

        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
            $response=array("Response"=>"Error","Message"=>'Please Enter User Id',"Result"=>array());
            echo json_encode($response);die();
        }

        $allProductsFromDB = DB::table('products')->where('UserId', $userId)->where('IsRead','Yes')->get();

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

        $response=array("Response"=>"Success","Message"=>'All User Product',"Result"=>$jsonArray);
        echo json_encode($response);die();
     }

     #Unread Products of Specific user
     public function getUnreadUserProducts(Request $request,$userId)
     {

        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
            $response=array("Response"=>"Error","Message"=>'Please Enter User Id',"Result"=>array());
            echo json_encode($response);die();
        }

        $allProductsFromDB = DB::table('products')->where('UserId', $userId)->where('IsRead','No')->get();

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

        $response=array("Response"=>"Success","Message"=>'All User Product',"Result"=>$jsonArray);
        echo json_encode($response);die();
     }

     public function markReadUserProducts(Request $request,$userId)
     {
        //$userId = $request->input('userId');
        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
            $response=array("Response"=>"Error","Message"=>'Please Enter User Id',"Result"=>array());
            echo json_encode($response);die();
        }

        DB::table('products')->where('UserId', $userId)->update(['IsRead' => 'Yes']);


        $response=array("Response"=>"Success","Message"=>'All Products Marked as Read',"Result"=>array());
        echo json_encode($response);die();

     }


     public function deleteUserProducts(Request $request,$userId)
     {

        //$userId = $request->input('userId');
        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
            $response=array("Response"=>"Error","Message"=>'Please Enter User Id',"Result"=>array());
            echo json_encode($response);die();
        }

        DB::table('products')->where('UserId', $userId)->delete();

        $response=array("Response"=>"Success","Message"=>'All Products Deleted ',"Result"=>array());
        echo json_encode($response);die();

     }
}
