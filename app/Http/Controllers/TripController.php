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
use App\Trip;
use App\Follower;
use App\Tripuser;
use App\Report;
use App\Http\Requests\Frontend\UserRegisterRequest;
use App\Http\Requests\Frontend\EditProfileRequest;
use App\Helpers\RESTAPIHelper;

use Validator;
use App\Http\Requests\Frontend\UserRegisterRequest2;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class TripController extends ApiBaseController {

    public function init()
    {
        return RESTAPIHelper::response([
            'tutorial_video' => Setting::extract('app.link.tutorial_video', ''),
        ]);
    }

     public function createTrip(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		$blankObject	=	(object)array();

        if(!isset($trip_name) || trim($trip_name)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_name');
        }
        elseif(!isset($trip_purpose) || trim($trip_purpose)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_purpose');
        }
        elseif(!isset($trip_detail) || trim($trip_detail)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please trip_detail');
        }
		elseif(!isset($trip_origin) || trim($trip_origin)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_origin');
        }
		elseif(!isset($trip_origin_latitude) || trim($trip_origin_latitude)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_origin_latitude');
        }
		elseif(!isset($trip_origin_longitude) || trim($trip_origin_longitude)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_origin_longitude');
        }
		elseif(!isset($trip_destination) || trim($trip_destination)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_destination');
        }
		elseif(!isset($trip_destination_latitude) || trim($trip_destination_latitude)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_destination_latitude');
        }
		elseif(!isset($trip_destination_longitude) || trim($trip_destination_longitude)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_destination_longitude');
        }
		elseif(!isset($trip_from) || trim($trip_from)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_from');
        }
		elseif(!isset($trip_to) || trim($trip_to)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_to');
        }
		elseif(!isset($age_bracket) || trim($age_bracket)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter age_bracket');
        }
		elseif(!isset($preferred_gender) || trim($preferred_gender)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter preferred_gender');
        }
		elseif(!isset($trip_interests) || trim($trip_interests)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_interests');
        }
		elseif(!isset($itinerary_id) || trim($itinerary_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter itinerary_id');
        }
		elseif(!isset($user_id) || trim($user_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter user_id');
        }
		
		
		
		
		$interestsArray	=	array(); 
		$trip_interestsArray	=	explode(",",$input['trip_interests']);
		
		#Saving in DB
		unset($input['trip_interests']);
		$tripId = DB::table('trips')->insertGetId($input);
		$input['trip_id']	=	$tripId;
		
		
		#print_r($trip_interestsArray);die();
		foreach($trip_interestsArray  as $eachInterestId)
		{
			$interestsArray[]	=	array("trip_id"=>$tripId, "interest_id"=>$eachInterestId);
		}
		
		DB::table('trip_interests')->insert($interestsArray);

		return RESTAPIHelper::response($input,'Success', 'Trip Created Successfully');
     }
	 
	 public function getAllTrips(Request $request)
     {
        header('Content-type: application/json');

        $allTripsFromDB = Trip::with('itinerary')->get();

        #Alternatively this can also be used; this is not standard
        #$allTripsFromDB = Trip::all();

        $jsonArray=array();
        $responseArray=array();
        $allTrips=array();

        foreach($allTripsFromDB as $Trip)
        {
            $thisTrip	=	array();
            $thisTrip	=	$Trip;

            $allTrips[]	=	$thisTrip;
        }

        $jsonArray['Trips']=$allTrips;
		return RESTAPIHelper::response($jsonArray,'Success', 'All Trips');

     }
	 
	 
	 public function getTrip(Request $request,$trip_id)
     {
        header('Content-type: application/json');
		
		$tripId	=	$trip_id;
        if(!isset($tripId) || trim($tripId)=='' || trim($tripId)==0)
        {
			return RESTAPIHelper::response(array(),'Error', 'Please Enter Trip Id');
            /*$response=array("Response"=>"Error","Message"=>'Please Enter Trip Id',"Result"=>array());
            echo json_encode($response);die();*/
        }
        $allTripsFromDB = Trip::with('itinerary')->where('id', $tripId)->get();


        $jsonArray=array();
        $responseArray=array();
        $allTrips=array();

        foreach($allTripsFromDB as $Trip)
        {
            $thisTrip	=	array();
            $thisTrip	=	$Trip;

            $allTrips[]	=	$thisTrip;
        }

        $jsonArray['Trip']=$allTrips;
		return RESTAPIHelper::response($jsonArray,'Success', 'Trip Details');
        /*$response=array("Response"=>"Success","Message"=>'All User Trip',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }
	 
	 
	 public function getUserTrips(Request $request,$user_id)
     {
		$userId	=	$user_id;
        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
            $response=array("Response"=>"Error","Message"=>'Please Enter User Id',"Result"=>array());
            echo json_encode($response);die();
        }

        $allTripsFromDB = Trip::with('itinerary')->where('user_id', $userId)->get();

        $jsonArray=array();
        $responseArray=array();
        $allTrips=array();

        foreach($allTripsFromDB as $Trip)
        {
            $thisTrip	=	array();
            $thisTrip	=	$Trip;

            $allTrips[]	=	$thisTrip;
        }

        $jsonArray['Trips']=$allTrips;
		return RESTAPIHelper::response($jsonArray,'Success', 'All User Trips');
        /*$response=array("Response"=>"Success","Message"=>'All User Trip',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }
	 
	 public function joinTrip(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		$blankObject	=	(object)array();

        if(!isset($trip_id) || trim($trip_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_id');
        }
        elseif(!isset($user_id) || trim($user_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter user_id');
        }
        
		
		$userRequestDB 	= DB::table('trip_users')->where('trip_id', $trip_id)->where('user_id', $user_id)->first();
		$userRequestDB	=	(array)$userRequestDB;
		
		
		if(empty($userRequestDB))
		{
			#submit the request 	
			 $tripRequest = Tripuser::create($input);
			 return RESTAPIHelper::response($blankObject,'Success', 'Your request to join this trip has been added');
		}
		else 
		{
			#Already Applied for this trip
			$curentStatus	=	$userRequestDB['status'];
			if($curentStatus =='0')
				{return RESTAPIHelper::response($blankObject,'Error', 'You have already reqeusted to join this trip; Pending Approval');}
			elseif($curentStatus =='1')
				{return RESTAPIHelper::response($blankObject,'Error', 'You have already joined this trip.');}
			elseif($curentStatus =='2')
				{return RESTAPIHelper::response($blankObject,'Error', 'You cannot join this trip.');}
		}
		

     }
	 
	 
	 public function acceptRequest(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		$blankObject	=	(object)array();

        if(!isset($trip_id) || trim($trip_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_id');
        }
        elseif(!isset($user_id) || trim($user_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter user_id');
        }
        
		
		$userRequestDB 	= DB::table('trip_users')->where('trip_id', $trip_id)->where('user_id', $user_id)->first();
		$userRequestDB	=	(array)$userRequestDB;
		
		
		if(empty($userRequestDB))
		{
			#submit the request 	
			 #$tripRequest = Tripuser::create($input);
			 return RESTAPIHelper::response($blankObject,'Error', 'This user has not applied for this trip');
		}
		else 
		{
			DB::table('trip_users')->where('trip_id', $trip_id)->where('user_id', $user_id)->update(['status' => '1']);
			return RESTAPIHelper::response($blankObject,'Success', 'Request Approved');
		}
		

     }
	
	 public function rejectRequest(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		$blankObject	=	(object)array();

        if(!isset($trip_id) || trim($trip_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter trip_id');
        }
        elseif(!isset($user_id) || trim($user_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter user_id');
        }
        
		
		$userRequestDB 	= DB::table('trip_users')->where('trip_id', $trip_id)->where('user_id', $user_id)->first();
		$userRequestDB	=	(array)$userRequestDB;
		
		
		if(empty($userRequestDB))
		{
			#submit the request 	
			 #$tripRequest = Tripuser::create($input);
			 return RESTAPIHelper::response($blankObject,'Error', 'This user has not applied for this trip');
		}
		else 
		{
			DB::table('trip_users')->where('trip_id', $trip_id)->where('user_id', $user_id)->update(['status' => '2']);
			return RESTAPIHelper::response($blankObject,'Success', 'Request DisApproved');
		}
		

     }
	 
	 

}
