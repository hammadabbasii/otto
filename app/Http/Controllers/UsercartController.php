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
use App\Usercart;
use App\Report;
use App\Http\Requests\Frontend\UserRegisterRequest;
use App\Http\Requests\Frontend\EditProfileRequest;
use App\Helpers\RESTAPIHelper;

use Validator;
use App\Http\Requests\Frontend\UserRegisterRequest2;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class UsercartController extends ApiBaseController {

    public function init()
    {
        return RESTAPIHelper::response([
            'tutorial_video' => Setting::extract('app.link.tutorial_video', ''),
        ]);
    }

     
	 
	 
	 public function addToCart(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		$blankObject	=	(object)array();

        if(!isset($product_id) || trim($product_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter product_id');
        }
        elseif(!isset($quantity) || trim($quantity)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter quantity');
        }
        elseif(!isset($user_id) || trim($user_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter user_id');
        }
		
		
		DB::table('usercart')->insert($input);

		return RESTAPIHelper::response($input,'Success', 'Product Added To Cart');
     }
	 
	 public function addToCartArray(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		$blankObject	=	(object)array();

        if(!isset($product_ids) || trim($product_ids)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter product_ids');
        }
        elseif(!isset($quantities) || trim($quantities)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter quantities');
        }
        elseif(!isset($user_id) || trim($user_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter user_id');
        }
		
		$productIdsArray	=	explode(",",$product_ids)	;
		$quantitiesArray	=	explode(",",$quantities)	;
		
		for($i=0;$i<count($productIdsArray);$i++)
		{
			$dataToInsert	=	array();
			$dataToInsert['product_id']	=	$productIdsArray[$i];
			$dataToInsert['quantity']	  =	$quantitiesArray[$i];
			$dataToInsert['user_id']	   =	$user_id;
			
			Usercart::create($dataToInsert);
		}
		
		#DB::table('usercart')->insert($input);

		return RESTAPIHelper::response($input,'Success', 'Products Added To Cart');
     }
	 
	 public function getUserCart(Request $request)
     {
		$input = $request->all();
        extract($input);
		
		$userId	=	$userId;
        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
            $response=array("Response"=>"Error","Message"=>'Please Enter User Id',"Result"=>array());
            echo json_encode($response);die();
        }

        $allItemsFromDB = Usercart::with('product')->where('user_id', $userId)->get();

        $jsonArray=array();
        $responseArray=array();
        $allItems=array();

        foreach($allItemsFromDB as $Item)
        {
            $thisItem	=	array();
            $thisItem	=	$Item;

            $allItems[]	=	$thisItem;
        }

        $jsonArray['Items']=$allItems;
		return RESTAPIHelper::response($jsonArray,'Success', 'All User Items');
        /*$response=array("Response"=>"Success","Message"=>'All User Item',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }
	 
	 
	 public function clearMyCart(Request $request)
     {
		$blankObject	=	(object)array(); 
		$input = $request->all();
        extract($input);
		
        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Enter User Id');
        }

         DB::table('usercart')->where('user_id', $userId)->delete();

        
		return RESTAPIHelper::response($blankObject,'Success', 'All Items Deleted From cart');
        /*$response=array("Response"=>"Success","Message"=>'All User Item',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }
	 

}
