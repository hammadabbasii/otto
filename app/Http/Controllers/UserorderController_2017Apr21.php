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
use App\Useraddress;
use App\Userorder;
use App\Report;
use App\Http\Requests\Frontend\UserRegisterRequest;
use App\Http\Requests\Frontend\EditProfileRequest;
use App\Helpers\RESTAPIHelper;

use Validator;
use App\Http\Requests\Frontend\UserRegisterRequest2;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class UserorderController extends ApiBaseController {

    public function init()
    {
        return RESTAPIHelper::response([
            'tutorial_video' => Setting::extract('app.link.tutorial_video', ''),
        ]);
    }

     
	 
	 
	 public function addOrder(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		$blankObject	=	(object)array();

        if(!isset($user_id) || trim($user_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter user_id');
        }
		elseif(!isset($items_ids) || trim($items_ids)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter items_ids');
        }
        elseif(!isset($quantities) || trim($quantities)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter quantities');
        }
		elseif(!isset($address_id) || trim($address_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter address_id');
        }
		elseif(!isset($payment_method) || trim($payment_method)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter payment_method');
        }
		
		$shipping_address	=	$this->GetThisAddress($address_id);
		#Marking all addresses as 0; not selected;
		DB::table('user_address')->where('user_id', $user_id)->update(['is_selected' => 0]);
		#Marking this as primary address
		DB::table('user_address')->where('id', $address_id)->update(['is_selected' => 1]);
		
		#Now getting the selected address, this will also mark it as primary
		$input['shipped_to_address']	=	json_encode($shipping_address);
		
		
		
		$orderId	=	DB::table('userorders')->insertGetId($input);
		
		$totalAmountOfOrder		  =	$totalDiscountedAmountOfOrder	=	$promotionId	=	0;
		$promotionIdsArray		   = 	array();
		$productsIdsArray			=	explode(",",$items_ids);
		$productsQuantitiessArray	=	explode(",",$quantities);
		
		
		$productDiscountsArray	=	array();
		
		
		#Getting Product wise Discount rate  
		/*$allProductsDiscountsDB = DB::table('promotion_items')->whereIn('product_id', $productsIdsArray)->get(['id', 'promotion_id', 'product_id', 'discount_percentage']);
		foreach($allProductsDiscountsDB as $eachProductDiscount)
		{
			
			$eachProductDiscount	=	(array)$eachProductDiscount;
			
			
			
			
			$thisProductId		  =	$eachProductDiscount['product_id'];
			$thisProductDiscount	=	$eachProductDiscount['discount_percentage'];
			$promotionIdsArray[$thisProductId]		=	$eachProductDiscount['promotion_id'];
			$productDiscountsArray[$thisProductId]	=	$thisProductDiscount;
		}*/
		
		##Get Selected Produtcs; to get Price etc 
		$allProductsFromDB = DB::table('products')->whereIn('id', $productsIdsArray)->get(['id', 'product_name', 'price', 'quantity', 'shipping_cost']);
		
		$productDetailsArray	=	array();
		foreach($allProductsFromDB as $eachProduct)
		{
			$eachProduct	  =	(array)$eachProduct;
			$thisProductId	=	$eachProduct['id'];
			$productDetailsArray[$thisProductId]	=	$eachProduct;
		}
		
		
		$dataForOrderedItems	=	array();
		$arrayCounter	=	0;
		foreach($productsIdsArray as $eachBoughtProduct)
		{
			
			$tempPrice	   =	$productDetailsArray[$eachBoughtProduct]['price'];		#Unit price of this item
			$tempQuantity	=	$productsQuantitiessArray[$arrayCounter];				 #Quantity Selected to buy 
			$itemAmount	  =	$tempPrice * $tempQuantity;
			
				
			$orderedItem	  			=	array();	
				$orderedItem['order_id']	= 	$orderId;
				$orderedItem['product_id']  = 	$eachBoughtProduct;
				$orderedItem['unit_price']  = 	$tempPrice;
				$orderedItem['quantity']	= 	$tempQuantity;	
				
				$orderedItem['sale_price']  =	$itemAmount;
				$orderedItem['total_price'] =	$itemAmount;
				$orderedItem['discount_percentage']   =	0;
				$orderedItem['promotion_id'] 		  =	0;
			
			$totalAmountOfOrder	+=	$orderedItem['sale_price'];
			
			#Checking Discount on this particular product	
			/*if(isset($productDiscountsArray[$eachBoughtProduct]))
			{
				$discountedPricePercentage	=	$productDiscountsArray[$eachBoughtProduct];	#Availble Discount on this product
				
				#Unit Price  x Quantity x (1 -  discount Percentage)
				$discountedPriceOfProduct	=	$itemAmount * (1-(($discountedPricePercentage)/100))	;

				$orderedItem['sale_price']			=	$discountedPriceOfProduct;
				$orderedItem['discount_percentage']   =	$discountedPricePercentage;
				$orderedItem['promotion_id'] 		  =	$promotionIdsArray[$eachBoughtProduct];
			}*/
			
			$totalDiscountedAmountOfOrder	+=	$orderedItem['sale_price'];
			$dataForOrderedItems[]			=	$orderedItem;
			
			$arrayCounter++;
		}
		#Adding Ordered Items to DB
		DB::table('orderitems')->insert($dataForOrderedItems);
		
		#Updating Total Amount Of Order
		DB::table('userorders')->where('id', $orderId)->update(['total_amount' => $totalAmountOfOrder,'discount' => ($totalAmountOfOrder-$totalDiscountedAmountOfOrder),'final_amount' => $totalDiscountedAmountOfOrder]);
		
		$input['shipped_to_address']	=	($shipping_address);

		return RESTAPIHelper::response($input,'Success', 'Order placed');
     }
	 
	 
	 
	 public function getUserPendingOrders(Request $request)
     {
		$input = $request->all();
        extract($input);
		
		$productsIdsArray	=	array();

        if(!isset($user_id) || trim($user_id)=='' || trim($user_id)==0)
        {
            return RESTAPIHelper::response((array()),'Error', 'user_id must have some value');
        }
	
		#Status goes here 
		 
		$allOrdersFromDB = Userorder::with('items')->where('user_id', $user_id)->where('status', 'pending')->get();
		
		$allOrdersFromDB = $allOrdersFromDB->toArray();
		#print_r($result);die();

        $jsonArray=array();
        $responseArray=array();
        $allOrders=array();

        foreach($allOrdersFromDB as $Order)
        {
			foreach($Order['items'] as $eachItem)	
			{
				$productsIdsArray[]	=	$eachItem['product_id'];
			}
        }

		##Get Selected Produtcs; to get Price etc 
		$allProductsFromDB = DB::table('products')->whereIn('id', $productsIdsArray)->get(['id', 'product_name', 'price', 'quantity', 'shipping_cost', 'product_image','product_description']);
		
		$productDetailsArray	=	array();
		foreach($allProductsFromDB as $eachProduct)
		{
			$eachProduct	  =	(array)$eachProduct;
			$thisProductId	=	$eachProduct['id'];
			$productDetailsArray[$thisProductId]	=	$eachProduct;
		}
		
		
		#Final Setting Response Array 
		foreach($allOrdersFromDB as $Order)
        {
            $thisOrder	=	array();
            $thisOrder	=	$Order;
			
			$thisOrder['order_date']	   =	date("Y-m-d",strtotime($thisOrder['created_at']));
			$thisOrder['order_time']	   =	date("h:i;s",strtotime($thisOrder['created_at']));
			
			#$thisOrder['delivery_date']	=	date("Y-m-d",strtotime($thisOrder['delivery_datetime']));
			$thisOrder['delivery_date']	=	$thisOrder['delivery_datetime'];
			#$thisOrder['delivery_time']	=	date("h:g;s",strtotime($thisOrder['delivery_datetime']));
			$thisOrder['delivery_time']	=	$thisOrder['delivery_datetime'];
			$thisOrder['shipped_to_address']	=	json_decode($thisOrder['shipped_to_address']);
			
			
			$allItemsArray	=	array();
			foreach($Order['items'] as $eachItem)	
			{
				$eachItem	=	$productDetailsArray[($eachItem['product_id'])];
				$allItemsArray[]	=	$eachItem;
			}
			$thisOrder['items']	=	$allItemsArray;
			
			
			
            $allOrders[]	=	$thisOrder;
        }

        $jsonArray['Orders']=$allOrders;
		return RESTAPIHelper::response($jsonArray,'Success', 'All User Orders');
        
     }
	 
	 public function getUserCompletedOrders(Request $request)
     {
		$input = $request->all();
        extract($input);
		
		$productsIdsArray	=	array();

        if(!isset($user_id) || trim($user_id)=='' || trim($user_id)==0)
        {
            return RESTAPIHelper::response((array()),'Error', 'user_id must have some value');
        }
	
		#Status goes here 
        #$allOrdersFromDB = DB::table('userorders')->with('items')->where('user_id', $user_id)->get();
		 
		$allOrdersFromDB = Userorder::with('items')->where('user_id', $user_id)->where('status', 'completed')->get();
		
		$allOrdersFromDB = $allOrdersFromDB->toArray();
		#print_r($result);die();

        $jsonArray=array();
        $responseArray=array();
        $allOrders=array();

        foreach($allOrdersFromDB as $Order)
        {
			foreach($Order['items'] as $eachItem)	
			{
				$productsIdsArray[]	=	$eachItem['product_id'];
			}
        }

		##Get Selected Produtcs; to get Price etc 
		$allProductsFromDB = DB::table('products')->whereIn('id', $productsIdsArray)->get(['id', 'product_name', 'price', 'quantity', 'shipping_cost', 'product_image','product_description']);
		
		$productDetailsArray	=	array();
		foreach($allProductsFromDB as $eachProduct)
		{
			$eachProduct	  =	(array)$eachProduct;
			$thisProductId	=	$eachProduct['id'];
			$productDetailsArray[$thisProductId]	=	$eachProduct;
		}
		
		
		#Final Setting Response Array 
		foreach($allOrdersFromDB as $Order)
        {
            $thisOrder	=	array();
            $thisOrder	=	$Order;
			
			$thisOrder['order_date']	   =	date("Y-m-d",strtotime($thisOrder['created_at']));
			$thisOrder['order_time']	   =	date("h:i;s",strtotime($thisOrder['created_at']));
			
			$thisOrder['delivery_date']	=	date("Y-m-d");
			$thisOrder['delivery_time']	=	date("h:i;s");
			
			$allItemsArray	=	array();
			foreach($Order['items'] as $eachItem)	
			{
				$eachItem	=	$productDetailsArray[($eachItem['product_id'])];
				$allItemsArray[]	=	$eachItem;
			}
			$thisOrder['items']	=	$allItemsArray;
			
			
            $allOrders[]	=	$thisOrder;
        }

        $jsonArray['Orders']=$allOrders;
		return RESTAPIHelper::response($jsonArray,'Success', 'All User Orders');
        
     }
	 
	
	function GetThisAddress($address_id)
	{
		$addresses	=	Useraddress::where('id',$address_id)->first();	
		
		return $addresses;
	}	 


/*{
"name": "address",
"in": "formData",
"description": "address",
"required": false,
"type": "string"
},
{
"name": "postal_code",
"in": "formData",
"description": "postal_code",
"required": false,
"type": "string"
},

*/

}
