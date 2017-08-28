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
use App\Userorder;
use App\Report;
use App\Http\Requests\Frontend\UserRegisterRequest;
use App\Http\Requests\Frontend\EditProfileRequest;
use App\Helpers\RESTAPIHelper;

use Validator;
use App\Http\Requests\Frontend\UserRegisterRequest2;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class PromotionController extends ApiBaseController {

    public function init()
    {
        return RESTAPIHelper::response([
            'tutorial_video' => Setting::extract('app.link.tutorial_video', ''),
        ]);
    }
     
	 
	 
	 public function addPromotion(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		$blankObject	=	(object)array();

        if(!isset($items_ids) || trim($items_ids)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter items_ids');
        }
        elseif(!isset($discounts) || trim($discounts)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter discounts');
        }
		elseif(!isset($promotion_name) || trim($promotion_name)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter promotion_name');
        }
		
		$newPromotionArray	=	array();
		$newPromotionArray['promotion_name']	=	$promotion_name;
		
		$promotionId	=	DB::table('promotions')->insertGetId($newPromotionArray);
		
		$totalAmountOfOrder		=	0;
		$productsIdsArray		  =	explode(",",$items_ids);
		$productsDiscountsArray	=	explode(",",$discounts);
		
		
		$dataForDiscountedItems	=	array();
		$arrayCounter	=	0;
		foreach($productsIdsArray as $eachdiscountedProduct)
		{
			$discountedItem	  			=	array();	
				$discountedItem['promotion_id']		  = 	$promotionId;
				$discountedItem['product_id']  			= 	$eachdiscountedProduct;
				$discountedItem['discount_percentage']   = 	$productsDiscountsArray[$arrayCounter];
			
			$dataForDiscountedItems[]	=	$discountedItem;
			
			$arrayCounter++;
		}
		#print_r($dataForDiscountedItems);die();
		
		#Adding Ordered Items to DB
		DB::table('promotion_items')->insert($dataForDiscountedItems);
		
		

		return RESTAPIHelper::response($blankObject,'Success', 'Prmotion Added Successfully');
     }
	 
	 
	 
	 

}
