<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Hash;
use Config;

use Gregwar\Image\Image;
use JWTAuth;

use App\Usernotification;
use App\User;
use App\Feedback;
use App\Userorder;
use App\Report;
use App\Http\Requests\Frontend\UserRegisterRequest;
use App\Http\Requests\Frontend\EditProfileRequest;
use App\Helpers\RESTAPIHelper;

use Validator;
use App\Http\Requests\Frontend\UserRegisterRequest2;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class UsernotificationController extends ApiBaseController {

	 
	 public function getUserNotifications(Request $request)
     {
		$input = $request->all();
        extract($input);
		
		$productsIdsArray	=	array();

        if(!isset($user_id) || trim($user_id)=='' || trim($user_id)==0)
        {
            return RESTAPIHelper::response((array()),'Error', 'user_id must have some value');
        }

		#Status goes here 
		$allUserNotificationsFromDB = Usernotification::with('order')->where('user_id', $user_id)->where('is_read', 0)->get();
		
        $jsonArray['Notifications']=$allUserNotificationsFromDB;
		return RESTAPIHelper::response($jsonArray,'Success', 'All User Notifications');
        
     }
	 
	 public function clearUserNotifications(Request $request)
     {
		$input = $request->all();
        extract($input);
		
		$productsIdsArray	=	array();

        if(!isset($user_id) || trim($user_id)=='' || trim($user_id)==0)
        {
            return RESTAPIHelper::response((array()),'Error', 'user_id must have some value');
        }

		#Status goes here 
		#Usernotification::update('order')->where('user_id', $user_id)->where('is_read', 0)->get();
		DB::table('notifications')->where('user_id', $user_id)->update(['is_read' => 1]);
		
       # $jsonArray['Notifications']=$allUserNotificationsFromDB;
		return RESTAPIHelper::response((array()),'Success', 'All User Notifications Marked as Read');
        
     }
	 
	 public function ContactDetails(Request $request)
     {
		$input = $request->all();
        extract($input);
		
		$productsIdsArray	=	array();

        if(!isset($user_id) )
        {
            return RESTAPIHelper::response((array()),'Error', 'user_id must have some value');
        }

		$responseAray	=	array();
		$contactDetails  =	array(); 
		$contactDetails['phone_number']	=	"+97317224970";
		$contactDetails['email_address']	=	"feedback@smart-mart.co";

		$responseAray['ContactDetails']	=	$contactDetails;
		
		
		
		return RESTAPIHelper::response($responseAray,'Success', 'Contact Details');
        
     }
	 
	 public function postFeedback(Request $request)
     {
		$input = $request->all();
        extract($input);
		
		#return RESTAPIHelper::response($input,'Success', 'Contact Details');
        if(!isset($user_id))
        {
            return RESTAPIHelper::response((array()),'Error', 'user_id must have some value');
        } 
		elseif(!$request->has('feedback_message'))
        {
            return RESTAPIHelper::response((array()),'Error', 'feedback_message must have some value');
        }
		
		$dateInsert	=	Feedback::create($input);
		
		return RESTAPIHelper::response($input,'Success', 'Feedback Posted');
        
     }
	 
	 
	 public function unclearUserNotifications(Request $request)
     {
		$input = $request->all();
        extract($input);
		
		$productsIdsArray	=	array();

        if(!isset($user_id) || trim($user_id)=='' || trim($user_id)==0)
        {
            return RESTAPIHelper::response((array()),'Error', 'user_id must have some value');
        }

		#Status goes here 
		#Usernotification::update('order')->where('user_id', $user_id)->where('is_read', 0)->get();
		DB::table('notifications')->where('user_id', $user_id)->update(['is_read' =>0]);
		
       # $jsonArray['Notifications']=$allUserNotificationsFromDB;
		return RESTAPIHelper::response((array()),'Success', 'All User Notifications Marked as UnRead');
        
     }
	 

}
