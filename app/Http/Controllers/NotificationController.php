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
use App\Http\Requests\Frontend\UserRegisterRequest;
use App\Http\Requests\Frontend\EditProfileRequest;
use App\Helpers\RESTAPIHelper;

use Validator;
use App\Http\Requests\Frontend\UserRegisterRequest2;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class NotificationController extends ApiBaseController {

    public function init()
    {
        return RESTAPIHelper::response([
            'tutorial_video' => Setting::extract('app.link.tutorial_video', ''),
        ]);
    }

    #Enlist all notifications
     public function getAllNotifications(Request $request)
     {
        header('Content-type: application/json');

        $allNotificationsFromDB = DB::table('notifications')->get();

        #Alternatively this can also be used; this is not standard
        #$allNotificationsFromDB = Notification::all();

        $jsonArray=array();
        $responseArray=array();
        $allNotifications=array();

        foreach($allNotificationsFromDB as $Notification)
        {
            $thisNotification	=	array();
            $thisNotification	=	$Notification;

            $allNotifications[]	=	$thisNotification;
        }

        $jsonArray['Notifications']=$allNotifications;
		return RESTAPIHelper::response($jsonArray,'Success', 'All User Notification');
        /*$response=array("Response"=>"Success","Message"=>'All User Notification',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }

     #Get a particular notification
     public function getNotification(Request $request,$notificationId)
     {
        header('Content-type: application/json');

        if(!isset($notificationId) || trim($notificationId)=='' || trim($notificationId)==0)
        {
			return RESTAPIHelper::response(array(),'Error', 'Please Enter Notification Id');
            /*$response=array("Response"=>"Error","Message"=>'Please Enter Notification Id',"Result"=>array());
            echo json_encode($response);die();*/
        }
        $allNotificationsFromDB = DB::table('notifications')->where('NotificationId', $notificationId)->get();


        $jsonArray=array();
        $responseArray=array();
        $allNotifications=array();

        foreach($allNotificationsFromDB as $Notification)
        {
            $thisNotification	=	array();
            $thisNotification	=	$Notification;

            $allNotifications[]	=	$thisNotification;
        }

        $jsonArray['Notifications']=$allNotifications;
		return RESTAPIHelper::response($jsonArray,'Success', 'All User Notification');
        /*$response=array("Response"=>"Success","Message"=>'All User Notification',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }

     //User Specific Notification, list all Notis of Specific User; All whether read or unread
     public function getUserNotifications(Request $request,$userId)
     {

        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
            $response=array("Response"=>"Error","Message"=>'Please Enter User Id',"Result"=>array());
            echo json_encode($response);die();
        }

        $allNotificationsFromDB = DB::table('notifications')->where('UserId', $userId)->get();

        $jsonArray=array();
        $responseArray=array();
        $allNotifications=array();

        foreach($allNotificationsFromDB as $Notification)
        {
            $thisNotification	=	array();
            $thisNotification	=	$Notification;

            $allNotifications[]	=	$thisNotification;
        }

        $jsonArray['Notifications']=$allNotifications;
		return RESTAPIHelper::response($jsonArray,'Success', 'All User Notification');
        /*$response=array("Response"=>"Success","Message"=>'All User Notification',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }

     #Read Notifications of Specific user
     public function getReadUserNotifications(Request $request,$userId)
     {

        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
			return RESTAPIHelper::response(array(),'Error', 'Please Enter User Id');
            /*$response=array("Response"=>"Error","Message"=>'Please Enter User Id',"Result"=>array());
            echo json_encode($response);die();*/
        }

        $allNotificationsFromDB = DB::table('notifications')->where('UserId', $userId)->where('IsRead','Yes')->get();

        $jsonArray=array();
        $responseArray=array();
        $allNotifications=array();

        foreach($allNotificationsFromDB as $Notification)
        {
            $thisNotification	=	array();
            $thisNotification	=	$Notification;

            $allNotifications[]	=	$thisNotification;
        }

        $jsonArray['Notifications']=$allNotifications;
		return RESTAPIHelper::response($jsonArray,'Success', 'All User Notification');
        /*$response=array("Response"=>"Success","Message"=>'All User Notification',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }

     #Unread Notifications of Specific user
     public function getUnreadUserNotifications(Request $request,$userId)
     {

        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
			return RESTAPIHelper::response(array(),'Error', 'Please Enter User Id');
            /*$response=array("Response"=>"Error","Message"=>'Please Enter User Id',"Result"=>array());
            echo json_encode($response);die();*/
        }

        $allNotificationsFromDB = DB::table('notifications')->where('UserId', $userId)->where('IsRead','No')->get();


        $jsonArray=array();
        $responseArray=array();
        $allNotifications=array();

        foreach($allNotificationsFromDB as $Notification)
        {
            $thisNotification	=	array();
            $thisNotification	=	$Notification;

            $allNotifications[]	=	$thisNotification;
        }

        $jsonArray['Notifications']=$allNotifications;
		return RESTAPIHelper::response($jsonArray,'Success', 'All User Notification');
        /*$response=array("Response"=>"Success","Message"=>'All User Notification',"Result"=>$jsonArray);
        echo json_encode($response);die();*/
     }

     public function markReadUserNotifications(Request $request,$userId)
     {
        //$userId = $request->input('userId');
        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
			return RESTAPIHelper::response(array(),'Error', 'Please Enter User Id');
            /*$response=array("Response"=>"Error","Message"=>'Please Enter User Id',"Result"=>array());
            echo json_encode($response);die();*/
        }

        DB::table('notifications')->where('UserId', $userId)->update(['IsRead' => 'Yes']);

		return RESTAPIHelper::response(array(),'Success', 'All Notifications Marked as Read');
       /* $response=array("Response"=>"Success","Message"=>'All Notifications Marked as Read',"Result"=>array());
        echo json_encode($response);die();*/

     }


     public function deleteUserNotifications(Request $request,$userId)
     {

        //$userId = $request->input('userId');
        header('Content-type: application/json');

        if(!isset($userId) || trim($userId)=='' || trim($userId)==0)
        {
			return RESTAPIHelper::response(array(),'Error', 'Please Enter User Id');
            /*$response=array("Response"=>"Error","Message"=>'Please Enter User Id',"Result"=>array());
            echo json_encode($response);die();*/
        }

        DB::table('notifications')->where('UserId', $userId)->delete();
		
		return RESTAPIHelper::response(array(),'Success', 'All Notifications Deleted');
        /*$response=array("Response"=>"Success","Message"=>'All Notifications Deleted ',"Result"=>array());
        echo json_encode($response);die();*/

     }


     public function sendNotifications(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

        header('Content-type: application/json');

        if(!isset($deviceToken) || trim($deviceToken)=='')
        {
			return RESTAPIHelper::response(array(),'Error', 'Please Enter Device Token');
           /* $response=array("Response"=>"Error","Message"=>'Please Enter Device Token',"Result"=>array());
            echo json_encode($response);die();*/
        }
        elseif(!isset($serverKey) || trim($serverKey)=='')
        {
			return RESTAPIHelper::response(array(),'Error', 'Please Enter Server Key');
            /*$response=array("Response"=>"Error","Message"=>'Please Enter Server Key',"Result"=>array());
            echo json_encode($response);die();*/
        }
        elseif(!isset($message) || trim($message)=='')
        {
			return RESTAPIHelper::response(array(),'Error', 'Please Enter Message');
            /*$response=array("Response"=>"Error","Message"=>'Please Enter Message',"Result"=>array());
            echo json_encode($response);die();*/
        }


        $userDeviceToken  = $deviceToken;
       $messageText      = $message;
       $serverApiKey     = $serverKey;
       $url = 'https://android.googleapis.com/gcm/send';
       #$serverApiKey = 'AIzaSyDKtEM0z7u9uTZDuRkVZQ31jP8uxyvUF3A'; #Have to set the key
       $reg = $userDeviceToken;

       $headers = array(
       'Content-Type:application/json',
       'Authorization:key='.$serverApiKey
       );
       $data = array('registration_ids' => array($reg), 'data' => array( 'type' => 'New', 'title' => 'Test Push', 'msg' => $messageText, 'url' => $url ));
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
		
		return RESTAPIHelper::response($response,'Success', 'Push Message Sent Successfully');
       /*$response=array("Response"=>"Success","Message"=>'Push Message Sent Successfully',"Result"=>$response);
       echo json_encode($response);die();*/
     }


}
