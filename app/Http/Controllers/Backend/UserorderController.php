<?php

namespace App\Http\Controllers\Backend;

use Config;

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Requests\Backend\TripRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
//use Validator;

use App\Trip;
use App\Tripuser;
use App\Usernotification;
use App\Userorder;
use App\Interest;
use App\Log;

use Illuminate\Support\Facades\DB;

class UserorderController extends BackendController
{
    public function getIndex()
    {
        $trips = Userorder::with('creator')->with('items')->get();
		$allTrips	=	array();
		foreach ($trips as $eachTripInstance) {
                $userData = $eachTripInstance['creator'];

                $thisUserObject = array('user_id' => $userData['id'], 'first_name' => $userData['first_name'], 'last_name' => $userData['last_name'],
                    'email' => $userData['email'], 'gender' => $userData['state'], 'phone' => $userData['phone_number'], 'address' => $userData['address'], 'profile_picture' => asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))));
                unset($eachTripInstance['creator']);
                $eachTripInstance['creator'] = $thisUserObject;

                $allTrips[] = $eachTripInstance;
            }
		$userorders	=	$allTrips;
        return backend_view( 'userorders.index', compact('userorders') );
    }

    public function edit(Trip $trip)
    {
        /*if ( !$trip->isAdmin() )
            abort(404);*/

        return backend_view( 'trips.edit', compact('trip') );
    }

    public function add()
    {
            return backend_view( 'trips.add' );
    }

   

    public function update(TripRequest $request, Trip $trip)
    {
        if ( $trip->isAdmin() )
            abort(404);

        $postData = $request->all();

        if ( $request->has('password') && $request->get('password', '') != '' ) {
            $postData['password'] = \Hash::make( $postData['password'] );
        }


        if($file = $request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture') ;
            $fileName = $trip->id . '-' . \Illuminate\Support\Str::random(12) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            echo $destinationPath = public_path().'/images/' ;
            $file->move($destinationPath,$fileName);
           echo $trip->profile_picture = $fileName ;
           $postData['profile_picture']= $fileName;
        }

       // dd($request);
        $trip->update( $postData );

        session()->flash('alert-success', 'Trip has been updated successfully!');
        return redirect( 'backend/trip/edit/' . $trip->id );
    }

    public function destroy(Userorder $userorder)
    {
        $thisOrderId	=	$userorder->id;
		
		#print_r($thisOrderId);die();
		
       
		
		#deleting all association
		#DB::table('notifications')->where('order_id', $thisOrderId)->delete();
		DB::table('orderitems')->where('order_id', $thisOrderId)->delete();
		
		
		#Now send push to owner of order 
		$orderDetail	=	Userorder::where('id',$thisOrderId)->with('user')->first()->toArray();
		extract($orderDetail['user']);
		#$device_type,$device_token
		$thisUserId	=	$orderDetail['user']['id'];
		$message	=	"Order No. $thisOrderId Cancelled";
		if($device_type == 'android' && $device_token != "") {
                    $apsArray = array('title' => "Alert", 'msg' => $message, 'sound' => 'default');
                    $this->SendPushNotificationAndroid($device_token, $apsArray);
                }
		elseif($device_type == 'ios' && $device_token != "") {
                    $apsArray = array('alert' => $message, $message => $message, 'message' => $message, 'sound' => 'default');
        			$this->SendPushIOS($device_token, $apsArray);
                }
		
		$notificationRecord	=	array(); 
		$notificationRecord['user_id']	=	$thisUserId;
		$notificationRecord['order_id']   =	$thisOrderId;
		$notificationRecord['notification_text']   =	$message;
		$notificationRecord['order_status']   =	'Cancelled';
		$notificationRecord['is_read']   =	0;
		
		Usernotification::create($notificationRecord);
		
		$userorder->delete();

        session()->flash('alert-success', 'Order has been deleted successfully!');
        return redirect( 'backend/orders' );
    }

    
	
	public function changeStatus(Request $request,$tripId)
     {
		
        //$tripId = $request->input('tripId');
        header('Content-type: application/json');
	   $allNotificationsFromDB = DB::table('trips')->where('id', $tripId)->get();
		
       $allNotificationsFromDB	=	(array)$allNotificationsFromDB;
	   
	   $currentStatus	=	$allNotificationsFromDB[0]->status;	   
	   if($currentStatus==0)
	   {
	   		DB::table('trips')->where('id', $tripId)->update(['status' => 1]);
	   }
	   else
	   {	DB::table('trips')->where('id', $tripId)->update(['status' => 0]);	}
	   
		echo $currentStatus;
     }
	 
	 
	 public function orderDetails($id)
     {

        $order        = Userorder::with('creator')->where('id',$id)->with('items')->first();
		if($order)
			{$order  =  $order->toArray();}
		
		$productIdsArray	=	array();
		$promotionIdsArray  =	array();
		$promotionDetails   =	array();
		$itemsDetails	   =	array();
		
		
		$promotionId	=	$order['promotion_id'];
		$shippedToAddress	=	$order['shipped_to_address'];
		$shippedToAddress	=	json_decode($shippedToAddress);
		$shippedToAddress	=	(array)$shippedToAddress;
		
		if(isset($shippedToAddress['appartment']))
		{
			if(trim($shippedToAddress['appartment']==''))
			{
				$shippedToAddress['appartment']	=	'N/A';
			}
		}
		if(isset($shippedToAddress['nearest_landmark']))
		{
			if(trim($shippedToAddress['nearest_landmark']==''))
			{
				$shippedToAddress['nearest_landmark']	=	'N/A';
			}
		}
		if(isset($shippedToAddress['floor']))
		{
			if(trim($shippedToAddress['floor']==''))
			{
				$shippedToAddress['floor']	=	'N/A';
			}
		}
		#print_r($shippedToAddress);die();
		
		#Get All IDs or Ordered Items 
		foreach($order['items'] as $allOrderedItems)
		{
			/*
			Array
				(
					[id] => 1
					[order_id] => 1
					[product_id] => 1
					[unit_price] => 200
					[quantity] => 10
					[total_price] => 2000
					[sale_price] => 1800
					[promotion_id] => 1
					[discount_percentage] => 10
					[created_at] => 2017-02-27 10:46:33
					[updated_at] => 2017-02-27 10:46:33
				)
			*/
			$productIdsArray[]	= $allOrderedItems['product_id'];
			$promotionIdsArray[]  = $allOrderedItems['promotion_id'];
			
		}
		
		#Get Ordered Items Details
		##Get Selected Produtcs; to get Price etc 
		$allProductsFromDB = DB::table('products')->whereIn('id', $productIdsArray)->get(['id', 'product_name', 'price', 'quantity', 'shipping_cost']);
		
		$productDetailsArray	=	array();
		foreach($allProductsFromDB as $eachProduct)
		{
			$eachProduct	  =	(array)$eachProduct;
			$thisProductId	=	$eachProduct['id'];
			$productDetailsArray[$thisProductId]	=	$eachProduct;
		}
		
		
		#Get Promotion Details
		if(!empty($promotionIdsArray))
		{
			$promotionDetailsFromDB = DB::table('promotions')->get();
			//->whereIn('id', $promotionIdsArray)
			$promotionDetailsFromDB = (array)$promotionDetailsFromDB;
			
			foreach($promotionDetailsFromDB as $eachPromotionDetails)
			{
				$eachPromotionDetails	  =	(array)$eachPromotionDetails;
				$thisPromotionId		   =	$eachPromotionDetails['id'];
				$promotionDetails[$thisPromotionId]  =	$eachPromotionDetails;
			}
		}
		
		
        return backend_view( 'userorders.details', compact('order','productDetailsArray','promotionDetails','shippedToAddress') );
    }
	
	function SendPushNotificationAndroid($device, $postArray) {

        $url = 'https://android.googleapis.com/gcm/send';
        //$url            = 'https://fcm.googleapis.com/fcm/send';
        $serverApiKey = "AIzaSyCv-mDEnkQXN5r0hHmtStXuuhJOGRiDK2M";
		#$serverApiKey = "AIzaSyDGcgVn3khVrHEJYTlx1bMkTvWI79bYFAQ";
        $reg = $device;

        $postArray['url'] = $url;

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $serverApiKey
        );


        $data = array(
            'registration_ids' => array($reg),
            'data' => $postArray
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        if ($headers)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        curl_close($ch);

        #print_r($response);
    }
	
	function SendPushIOS($device, $apsArray) {

        // echo $ckpem = $_SERVER['DOCUMENT_ROOT'].'\portfolio\albacars\app\controller\ck.pem';
        $ckpem = public_path() . '\certificates\pushDevCert.pem';

        $payload['aps'] = $apsArray; // array('alert' => $title, 'message' => $msg, 'sound' => 'default');
//    $payload['aps'] = array(
//       'alert' => array(
//          'body' => $title,
//          'action-loc-key' => 'Bango App',
//       ),
//       'badge' => 2,
//       'sound' => 'oven.caf',
//    );

        $payload = json_encode($payload);

        $options = array('ssl' => array(
                'local_cert' => $ckpem,
                'passphrase' => '1'
        ));

        $streamContext = stream_context_create();
        stream_context_set_option($streamContext, $options);
        $apns = stream_socket_client('ssl://gateway.push.apple.com:2195', $error, $errorString, 60, STREAM_CLIENT_CONNECT, $streamContext);

        //dd($apns);
        $apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $device)) . chr(0) . chr(strlen($payload)) . $payload;



        $result = fwrite($apns, $apnsMessage);


   /* if (!$result)
	{echo 'Message not delivered' ;die();}
    else {echo 'Message successfully delivered' ;die();}*/

        fclose($apns);
    }	
}
