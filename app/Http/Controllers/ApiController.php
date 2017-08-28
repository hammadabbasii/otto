<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Hash;
use Config;
use Gregwar\Image\Image;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use App\Setting;
use App\User;
use App\Follower;
use App\Report;
use App\Http\Requests\Frontend\UserRegisterRequest;
use App\Http\Requests\Frontend\EditProfileRequest;
use App\Helpers\RESTAPIHelper;
use Validator;
use App\Http\Requests\Frontend\UserRegisterRequest2;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ApiController extends ApiBaseController {

    public function init() {
        return RESTAPIHelper::response([
                    'tutorial_video' => Setting::extract('app.link.tutorial_video', ''),
        ]);
    }

    public function getGuideBook() {
        return RESTAPIHelper::response([
                    'guidebook' => Setting::extract('app.link.guide_book', ''),
        ]);
    }

//public function register(UserRegisterRequest $request)
    public function register(UserRegisterRequest $request) {

        $input = $request->all();
        print_r($input);
        die();
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = User::ROLE_MEMBER;

//        print_r($request->file('profile_picture'));
//        die();
        if ($request->hasFile('profile_picture')) {
            $imageName = Str::random(12) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $path = public_path(Config::get('constants.front.dir.profilePicPath'));
            $request->file('profile_picture')->move($path, $imageName);

            if (Image::open($path . '/' . $imageName)->scaleResize(200, 200)->save($path . '/' . $imageName)) {
                $input['profile_picture'] = $imageName;
            }
        }

        $userCreated = User::create($input);



        return $this->login($request);
    }

    public function login(Request $request) {
        $input = $request->all();
        extract($input);
        if (!isset($device_type) || trim($device_type) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter device_type');
        } elseif (!isset($device_token) || trim($device_token) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter device_token');
        }
        $input = $request->only(['email', 'password']);
        $input['role_id'] = User::ROLE_MEMBER;

        if (!$token = JWTAuth::attempt($input)) {
            return RESTAPIHelper::response(array(), 'Error', 'Invalid credentials, please try-again.');
        }

        $userData = JWTAuth::toUser($token)->toArray();

        /* Do your additional/manual validation here like email verification or enable/disable */

        $result = [
            'user_id' => $userData['id'],
            'full_name' => $userData['full_name'],
            'email' => $userData['email'],
            'phone_number' => $userData['phone_number'],
            'address' => $userData['address'],
            'profile_picture' => asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))),
            '_token' => $token,
                //'is_purchased'    => $userData['is_purchased'],
        ];
        $userId = $userData['id'];
        DB::table('users')->where('id', $userId)->update(array('device_type' => $device_type, 'device_token' => $device_token));
        return RESTAPIHelper::response($result);
    }

    ##Added irfan hammad 

    public function socialLogin(Request $request) {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

        header('Content-type: application/json');

        if (!isset($socialLoginId) || trim($socialLoginId) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter Social ID');
        } elseif (!isset($socialPlatform) || trim($socialPlatform) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter Social Platform');
        } elseif (!isset($fullName) || trim($fullName) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter Full Name');
        } elseif (!isset($device_type) || trim($device_type) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter device_type');
        } elseif (!isset($device_token) || trim($device_token) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter device_token');
        }



        #echo $token['Tymon\JWTAuth\Tokenvalue'];die();      
        $userData = DB::table('users')->where('social_media_id', $socialLoginId)->get();

        if (!empty($userData)) {
            //Login 
            $userData = (array) $userData[0];

            $credentialArray = array();
            $credentialArray['email'] = $userData['email'];
            $credentialArray['password'] = 'password';

            $token = '';
            $token = JWTAuth::attempt($credentialArray);


            $result = [
                'user_id' => $userData['id'],
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'email' => $userData['email'],
                'gender' => $userData['state'],
                'phone' => $userData['phone_number'],
                'address' => $userData['address'],
                'profile_picture' => asset(Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))),
                '_token' => $token
                    //'is_purchased'    => $userData['is_purchased'],
            ];

            $userId = $userData['id'];
            DB::table('users')->where('id', $userId)->update(array('device_type' => $device_type, 'device_token' => $device_token));

            return RESTAPIHelper::response($result, 'Success', 'Logged In Successfully');
        } else {

            $dummyEmail = $socialLoginId . "@" . $socialPlatform . ".com";
            $dummyPassword = Hash::make('password');




            $NewArray = array();
            $NewArray['social_media_id'] = $socialLoginId;
            $NewArray['social_media_platform'] = $socialPlatform;
            $NewArray['full_name'] = $fullName;
            $NewArray['email'] = $dummyEmail;
            $NewArray['password'] = $dummyPassword;
            $NewArray['device_token'] = $device_token;
            $NewArray['device_type'] = $device_type;

            #$userCreated = User::create($NewArray);

            $userId = DB::table('users')->insertGetId($NewArray);

            $NewArray['id'] = $userId;

            $credentialArray = array();
            $credentialArray['email'] = $dummyEmail;
            $credentialArray['password'] = 'password';

            $token = '';
            $token = JWTAuth::attempt($credentialArray);


            $result = [
                'user_id' => $NewArray['id'],
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'gender' => '',
                'phone' => '',
                'address' => '',
                'profile_picture' => '',
                '_token' => $token
                    //'is_purchased'    => $userData['is_purchased'],
            ];

            return RESTAPIHelper::response($result, 'Success', 'User Created Successfully');
        }
    }

    public function follow(Request $request) {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

        header('Content-type: application/json');

        if (!isset($user_id) || trim($user_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter User ID');
        } elseif (!isset($following_id) || trim($following_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter Following User Id');
        }


        #echo $token['Tymon\JWTAuth\Tokenvalue'];die();      
        $checkFollowing = DB::table('followers')->where('follower_id', $user_id)->where('following_id', $following_id)->get();

        if (!empty($checkFollowing)) {


            return RESTAPIHelper::response(array(), 'Error', 'You are already following this user.');
        } else {


            $NewArray = array();
            $NewArray['follower_id'] = $user_id;
            $NewArray['following_id'] = $following_id;

            #$userCreated = User::create($NewArray);

            $userId = DB::table('followers')->insert($NewArray);


            return RESTAPIHelper::response(array(), 'Success', 'user Followed Succesfully');
        }
    }

    public function unfollow(Request $request) {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

        header('Content-type: application/json');

        if (!isset($user_id) || trim($user_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter User ID');
        } elseif (!isset($following_id) || trim($following_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter Following User Id');
        }


        #echo $token['Tymon\JWTAuth\Tokenvalue'];die();      
        $checkFollowing = DB::table('followers')->where('follower_id', $user_id)->where('following_id', $following_id)->delete();

        if (!empty($checkFollowing)) {



            return RESTAPIHelper::response(array(), 'Success', 'User Unfollowed Successfully');
        }
    }

    public function getfollowers(Request $request, $user_id) {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

        header('Content-type: application/json');

        if (!isset($user_id) || trim($user_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter User ID');
        }


        #echo $token['Tymon\JWTAuth\Tokenvalue'];die();      
        //$checkFollowing = DB::table('followers')->where('following_id', $user_id)->get();

        $checkFollowing = Follower::with('user')->where('following_id', $user_id)->get();
        $allFollowers = array();
        if (!empty($checkFollowing)) {


            foreach ($checkFollowing as $eachFollowerInstance) {
                $userData = $eachFollowerInstance['user'];

                $thisUserObject = array('user_id' => $userData['id'], 'first_name' => $userData['first_name'], 'last_name' => $userData['last_name'],
                    'email' => $userData['email'], 'gender' => $userData['state'], 'phone' => $userData['phone_number'], 'address' => $userData['address'], 'profile_picture' => asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))));
                unset($eachFollowerInstance['user']);
                $eachFollowerInstance['user'] = $thisUserObject;

                $allFollowers[] = $eachFollowerInstance;
            }

            return RESTAPIHelper::response($allFollowers, 'Success', 'Followers List');
        } else {


            return RESTAPIHelper::response($checkFollowing, 'Error', 'No Followers Found');
        }
    }

    public function getfollowings(Request $request, $user_id) {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

        header('Content-type: application/json');

        if (!isset($user_id) || trim($user_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter User ID');
        }


        #echo $token['Tymon\JWTAuth\Tokenvalue'];die();      
        //$checkFollowing = DB::table('followers')->where('following_id', $user_id)->get();

        $checkFollowing = Follower::with('user2')->where('follower_id', $user_id)->get();
        $allFollowings = array();

        if (!empty($checkFollowing)) {

            foreach ($checkFollowing as $eachFollowerInstance) {
                $userData = $eachFollowerInstance['user2'];

                $thisUserObject = array('user_id' => $userData['id'], 'first_name' => $userData['first_name'], 'last_name' => $userData['last_name'],
                    'email' => $userData['email'], 'gender' => $userData['state'], 'phone' => $userData['phone_number'], 'address' => $userData['address'], 'profile_picture' => asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))));
                unset($eachFollowerInstance['user2']);
                $eachFollowerInstance['user'] = $thisUserObject;

                $allFollowings[] = $eachFollowerInstance;
            }


            return RESTAPIHelper::response($allFollowings, 'Success', 'Followers List');
        } else {


            return RESTAPIHelper::response($checkFollowing, 'Error', 'No Followers Found');
        }
    }

    public function resetPassword(Request $request) {
        $userRequested = User::where([
                    'email' => $request->get('email', ''),
                    'role_id' => User::ROLE_MEMBER,
                ])->first();

        if (!$userRequested)
            return RESTAPIHelper::response('Email not found in database.', false, 'invalid_email');

        $passwordGenerated = \Illuminate\Support\Str::random(12);

        $userRequested->password = Hash::make($passwordGenerated);
        $userRequested->save();

        // Send reset password email
        $emailBody = "You have requested to reset a password of your account, please find your new generated password below:

New Password: " . $passwordGenerated . "

Thanks.";
        \Mail::raw($emailBody, function($m) use($userRequested) {
            $m->to($userRequested->email)->from(env('MAIL_USERNAME'))->subject('Reset Password - ValuationApp');
        });

        return RESTAPIHelper::response('We have sent you new password in your email, please check your inbox as well as spam/junk folder.');
    }

    public function logout(Request $request) {

        $incomingToken = $this->extractToken();
        $userData = JWTAuth::toUser($incomingToken)->toArray();
        DB::table('users')->where('id', $userData['id'])->update(array('device_type' => '', 'device_token' => ''));

        JWTAuth::invalidate($incomingToken);

        return RESTAPIHelper::response(array(), 'Success', 'Logout Successfully');
    }

    public function getProfile(Request $request, $user_id) {

        $incomingToken = $this->extractToken();

        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

        header('Content-type: application/json');

        if (!isset($user_id) || trim($user_id) == '') {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter User ID');
        }

        if (trim($user_id) == '0' || trim($user_id) == 0 || trim($user_id) == null) {
            return RESTAPIHelper::response(array(), 'Error', 'Please Enter Valid User ID');
        }

        $userData = User::where('id', $user_id)->first();

        if ($userData) {
            $userData = $userData->toArray();
            $result = [
                'user_id' => $userData['id'],
                'full_name' => $userData['full_name'],
                'email' => $userData['email'],
                'phone_number' => $userData['phone_number'],
                'address' => $userData['address'],
                'profile_picture' => asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))),
                '_token' => $incomingToken
            ];
            $userId = $userData['id'];
        } else {
            return RESTAPIHelper::response(array(), 'Error', 'No User found with Provided User Id');
        }

        return RESTAPIHelper::response($result, 'Success', 'User Details');
    }

    public function updateMyProfile(EditProfileRequest $request) {
        $user = $this->getUserInstance();

        if (!$user)
            return RESTAPIHelper::response('Something went wrong here.', false);

        $dataToUpdate = array_filter([
            'first_name' => $request->get('first_name', null),
            'last_name' => $request->get('last_name', null),
            'email' => $request->get('email', null),
            'state' => $request->get('state', null),
            'country' => $request->get('country', null),
            'phone' => $request->get('phone', null),
            'company_name' => $request->get('company_name', null),
        ]);

        if ($request->has('password') && $request->get('password', '') !== '') {
            $dataToUpdate['password'] = \Hash::make($request->get('password'));
        }

        if ($request->hasFile('profile_picture')) {
            $imageName = Str::random(12) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $path = public_path(Config::get('constants.front.dir.profilePicPath'));
            $request->file('profile_picture')->move($path, $imageName);

            if (Image::open($path . '/' . $imageName)->scaleResize(200, 200)->save($path . '/' . $imageName)) {
                $dataToUpdate['profile_picture'] = $imageName;
            }
        }

        if (empty($dataToUpdate))
            return RESTAPIHelper::response('Nothing to update', false);


        $user->update($dataToUpdate);

        // Set default profile picture
        $user->profile_picture = asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($user['profile_picture'] ?: Config::get('constants.front.default.profilePic')));

        return RESTAPIHelper::response(collect($user)->only([
                            'first_name',
                            'last_name',
                            'email',
                            'state',
                            'country',
                            'phone',
                            'company_name',
                            'profile_picture',
                            'is_purchased',
        ]));


        //return RESTAPIHelper::emptyResponse();
    }

    public function getUsers(Request $request) {

        $deviceType = isset($request['device_type']) ? $request['device_type'] : NULL;

        $conditions = array();
        if (!is_null($deviceType))
            $conditions['device_type'] = $deviceType;


        $user = User::where($conditions)->get();
        //  $user = User::all()->toArray();



        /* Do your additional/manual validation here like email verification or enable/disable */

        /*        $result   = [
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
          ]; */

        return RESTAPIHelper::response($user);
    }

    public function forgotPassword(Request $request) {

        if (!$request->input('email')) {
            return RESTAPIHelper::response('', 'Error', 'Parameter Missing', false);
        }

        $userRequested = User::where([
                    'email' => $request->input('email')
                ])->first();

        if (!$userRequested)
            return RESTAPIHelper::response(((object) array()), 'Error', 'Email not found in database.');

        $passwordGenerated = \Illuminate\Support\Str::random(12);

        $userRequested->password = Hash::make($passwordGenerated);
        $userRequested->save();


        $to = $request->input('email');
        $subject = "Forgot/New Password - Smart Mart";


        $message = "
            <html>
            <head>
            <title>Dear " . $userRequested['user_name'] . "</title>
            </head>
            <body>
            <p>You have requested to reset a password of your account, please find your new generated password below</p>
            <table>
            <tr>
            <th>New Password</th>
            </tr>
            <tr>
            <td>" . $passwordGenerated . "</td>
            </tr>
            </table>
            </body>
            </html>
            ";

// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <info@stagingic.com>' . "\r\n";


        mail($to, $subject, $message, $headers);
        return RESTAPIHelper::response(((object) array()), 'Success', 'We have sent you new password in your email, please check your inbox as well as spam/junk folder.');
    }

}
