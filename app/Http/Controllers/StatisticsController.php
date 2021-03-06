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

class StatisticsController extends ApiBaseController {


//public function register(UserRegisterRequest $request)
    public function getRegisterationStats()
    {


        $registrationStats['total_users']                   = User::where('role_id', User::ROLE_MEMBER)->count();
        $registrationStats['total_active_users']            = User::where('role_id', User::ROLE_MEMBER)->where('status', User::STATUS_ACTIVE)->count();
        $registrationStats['total_blocked_users']           = User::where('role_id', User::ROLE_MEMBER)->where('status', User::STATUS_BLOCKED)->count();
        $registrationStats['total_android_users']           = User::where('role_id', User::ROLE_MEMBER)->where('device_type', User::DEVICE_TYPE_ANDROID)->count();
        $registrationStats['total_android_users_percentage']= floor(($registrationStats['total_android_users']/$registrationStats['total_users'])*100);
        $registrationStats['total_ios_users']               = User::where('role_id', User::ROLE_MEMBER)->where('device_type', User::DEVICE_TYPE_IOS)->count();
        $registrationStats['total_ios_users_percentage']    = floor(($registrationStats['total_ios_users']/$registrationStats['total_users'])*100);
        $registrationStats['total_web_users']               = User::where('role_id', User::ROLE_MEMBER)->where('device_type', User::DEVICE_TYPE_WEB)->count();
        $registrationStats['total_web_users_percentage']    = floor(($registrationStats['total_web_users']/$registrationStats['total_users'])*100);
        $registrationStats['total_fb_users']                = User::where('role_id', User::ROLE_MEMBER)->where('social_media_platform', User::SOCIALMEDIA_PLATFORM_FB)->count();
		$registrationStats['total_trips']                   = Userorder::count();



         return RESTAPIHelper::response($registrationStats);
    }

    public function login(Request $request)
    {
        $input            = $request->only(['email', 'password']);
        $input['role_id'] = User::ROLE_MEMBER;

        if (!$token = JWTAuth::attempt($input)) {
            return RESTAPIHelper::response('Invalid credentials, please try-again.', false);
        }

        $userData = JWTAuth::toUser($token)->toArray();

        /* Do your additional/manual validation here like email verification or enable/disable */

        $result   = [
            'user_id'         =>  $userData['id'],
            'first_name'      =>  $userData['first_name'],
            'last_name'       =>  $userData['last_name'],
            'email'           =>  $userData['email'],
            'state'           =>  $userData['state'],
            'phone'           =>  $userData['phone'],
            'company_name'    =>  $userData['company_name'],
            'profile_picture' =>  asset( Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic')) ),
            '_token'          =>  $token,
            //'is_purchased'    => $userData['is_purchased'],
        ];

        return RESTAPIHelper::response( $result );
    }

    public function resetPassword(Request $request) {
        $userRequested = User::where([
            'email'   =>  $request->get('email', ''),
            'role_id' =>  User::ROLE_MEMBER,
        ])->first();

        if ( !$userRequested )
            return RESTAPIHelper::response('Email not found in database.', false, 'invalid_email');

        $passwordGenerated = \Illuminate\Support\Str::random(12);

        $userRequested->password = Hash::make( $passwordGenerated );
        $userRequested->save();

        // Send reset password email
        $emailBody = "You have requested to reset a password of your account, please find your new generated password below:

New Password: " . $passwordGenerated . "

Thanks.";
        \Mail::raw( $emailBody, function($m) use($userRequested) {
            $m->to( $userRequested->email )->from( env('MAIL_USERNAME') )->subject('Reset Password - ValuationApp');
        });

        return RESTAPIHelper::response( 'We have sent you new password in your email, please check your inbox as well as spam/junk folder.' );
    }

    public function logout(Request $request)
    {
        JWTAuth::invalidate( $this->extractToken() );

        return RESTAPIHelper::emptyResponse();
    }

    
    
    
}