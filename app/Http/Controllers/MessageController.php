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
use App\Message;
use App\Follower;
use App\Report;
use App\Http\Requests\Frontend\UserRegisterRequest;
use App\Http\Requests\Frontend\EditProfileRequest;
use App\Helpers\RESTAPIHelper;
use Validator;
use App\Http\Requests\Frontend\UserRegisterRequest2;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MessageController extends ApiBaseController {

    public function init() {
        return RESTAPIHelper::response([
                    'tutorial_video' => Setting::extract('app.link.tutorial_video', ''),
        ]);
    }

    public function sendMessage(Request $request) {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');
        # header('Content-type: application/json');

        $blankObject = (object) array();

        if (!isset($sender_id) || trim($sender_id) == '') {
            return RESTAPIHelper::response($blankObject, 'Error', 'Please Enter sender_id');
        } elseif (!isset($trip_id) || trim($trip_id) == '') {
            return RESTAPIHelper::response($blankObject, 'Error', 'Please Enter trip_id');
        } elseif (!isset($message_text) || trim($message_text) == '') {
            return RESTAPIHelper::response($blankObject, 'Error', 'Please message_text');
        }


        #Saving in DB
        $messageId = DB::table('messages')->insertGetId($input);

        return RESTAPIHelper::response($input, 'Success', 'Message Sent Successfully');
    }

    public function getTripMessages(Request $request , $trip_id) {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

        header('Content-type: application/json');

        if (!isset($trip_id) || trim($trip_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter Trip ID');
        }


        #echo $token['Tymon\JWTAuth\Tokenvalue'];die();      
        //$checkFollowing = DB::table('followers')->where('following_id', $user_id)->get();

        $getMessages = Message::with('user')->where('trip_id', $trip_id)->orderBy('created_at', 'desc')->get();
        $allMessages = array();
        if (!empty($getMessages)) {


            foreach ($getMessages as $eachMessage) {
                $userData = $eachMessage['user'];

                $thisUserObject = array('user_id' => $userData['id'], 'first_name' => $userData['first_name'], 'last_name' => $userData['last_name'],
                    'email' => $userData['email'], 'gender' => $userData['state'], 'phone' => $userData['phone_number'], 'address' => $userData['address'], 'profile_picture' => asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))));
                unset($eachMessage['user']);
                $eachMessage['user'] = $thisUserObject;

                $allMessages[] = $eachMessage;
            }

            return RESTAPIHelper::response($allMessages, 'Success', 'Followers List');
        } else {


            return RESTAPIHelper::response($checkFollowing, 'Error', 'No Followers Found');
        }
    }

}
