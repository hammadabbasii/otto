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
use App\Report;
use App\Http\Requests\Frontend\UserRegisterRequest;
use App\Http\Requests\Frontend\EditProfileRequest;
use App\Helpers\RESTAPIHelper;

use Validator;
use App\Http\Requests\Frontend\UserRegisterRequest2;
use Illuminate\Support\Str;

class UserController extends ApiBaseController {

    public function init()
    {
        return RESTAPIHelper::response([
            'tutorial_video' => Setting::extract('app.link.tutorial_video', ''),
        ]);
    }

    public function getGuideBook()
    {
        return RESTAPIHelper::response([
            'guidebook' => Setting::extract('app.link.guide_book', ''),
        ]);
    }



public function register(UserRegisterRequest $request)
    {
        $input             = $request->all();
		
        $input['password'] = Hash::make($input['password']);
        $input['role_id']  = User::ROLE_MEMBER;
		
		#Profile Picture Upload
		if ($request->hasFile('profile_picture')) {
            $imageName = Str::random(12) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $path = public_path(Config::get('constants.front.dir.profilePicPath'));
            $request->file('profile_picture')->move($path, $imageName);

            if (Image::open($path . '/' . $imageName)->scaleResize(200)->save($path . '/' . $imageName)) {
                $input['profile_picture'] = $imageName;
            }
        }
        $userCreated = User::create($input);

        return $this->login($request,'1');
		
    }




    public function login(Request $request,$is_register = '')
    {
        $input            = $request->only(['email', 'password']);
        $input['role_id'] = User::ROLE_MEMBER;

        if (!$token = JWTAuth::attempt($input)) {
            return RESTAPIHelper::response('Invalid credentials, please try-again.', false);
        }

        $userData = JWTAuth::toUser($token)->toArray();

        /* Do your additional/manual validation here like email verification or enable/disable */
		
		$userData['profile_picture'] = asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic')));

        $result   = [
            'user_id'         =>  $userData['id'],
            'full_name'       =>  $userData['full_name'],
            'email'           =>  $userData['email'],
            'phone_number'    =>  $userData['phone_number'],
			'postal_code' => $userData['postal_code'],
            'address'       =>  $userData['address'],
            'profile_picture' =>  $userData['profile_picture'],
            '_token'          =>  $token
        ];

        if($is_register)
        {
            $dev_msg = "User register successfully";
        }else{
            $dev_msg = "User Logged In successfully";
        }

        return RESTAPIHelper::response( $result ,'Success',$dev_msg);
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

	public function updateUser(EditProfileRequest $request) {

        $input             = $request->all();
        $userId            = $input['user_id'];
        $oldPassword       = isset($input['old_password']) ? $input['old_password'] : '';
        $password          = isset($input['password']) ? $input['password'] : '';
		
		$incomingToken = $this->extractToken();


        /*$is_authorized      = $this->checkTokenValidity($userId);
        if($is_authorized == 0) {return RESTAPIHelper::response('','Error','Invalid Token or User Id', false); }*/

        $userData = $this->getUserInstance();
        
        if ($userData->status == 0) {
			return RESTAPIHelper::response(array(), 'Error', 'You are blocked by administrator');
        }

        $user               = $this->getUserInstance();
       // dd($user);
        if($user) {

            $dataToUpdate = array_filter([
                'full_name' => $request->get('full_name', null),
				'address' => $request->get('address', null),
				'postal_code' => $request->get('postal_code', null),
                'phone_number' => $request->get('phone_number', null),
                'state' => $request->get('state', null)
            ]);

            if ($request->has('password') && $request->get('password', '') !== '') {

                // checking old password is correct ....
                if ($request->has('old_password') && $request->get('old_password', '') !== '') {

                    $loginattemp['email']   =  $user->email;
                    $loginattemp['password'] =  $oldPassword;

                    // checking old Password ....
                    if (!$token = JWTAuth::attempt($loginattemp)) {
						return RESTAPIHelper::response(array(), 'Error', 'Wrong old password provided');
                    }

                    $dataToUpdate['password'] = \Hash::make($request->get('password'));

                }

            }
			
			if ($request->hasFile('profile_picture')) {
            $imageName = Str::random(12) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $path = public_path(Config::get('constants.front.dir.profilePicPath'));
            $request->file('profile_picture')->move($path, $imageName);

            if (Image::open($path . '/' . $imageName)->scaleResize(200)->save($path . '/' . $imageName)) {
                $dataToUpdate['profile_picture'] = $imageName;
            }
        }


            if (empty($dataToUpdate))
				return RESTAPIHelper::response(array(), 'Error', 'Nothing to update');
				

            $user->update($dataToUpdate);


            $userData	=	$user;
			$result = [
				'user_id' => $userData['id'],
				'full_name' => $userData['full_name'],
				'email' => $userData['email'],
				'phone_number' => $userData['phone_number'],
				'postal_code' => $userData['postal_code'],
				'address' => $userData['address'],
				'profile_picture' => asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))),
				'_token' => $incomingToken
			];

            $dev_msg = "Profile updated successfully";
            return RESTAPIHelper::response( $result ,'Success',$dev_msg);


        } else {
            // if no user object found .....
            return RESTAPIHelper::response(array(), 'Error', 'No User found with Provided User Id');
        }

        //return RESTAPIHelper::emptyResponse();
    }    
	
	public function updatePassword(EditProfileRequest $request) {

        $input             = $request->all();
        $userId            = $input['user_id'];
        $password          = isset($input['password']) ? $input['password'] : '';
		
		$incomingToken = $this->extractToken();

        /*$is_authorized      = $this->checkTokenValidity($userId);
        if($is_authorized == 0) {return RESTAPIHelper::response('','Error','Invalid Token or User Id', false); }*/

        $userData = $this->getUserInstance();
        
        if ($userData->status == 0) {
			return RESTAPIHelper::response(array(), 'Error', 'You are blocked by administrator');
        }

        $user               = $this->getUserInstance();
       // dd($user);
        if($user) {

            $dataToUpdate = array();

            if ($request->has('password') && $request->get('password', '') !== '') {
                // checking old password is correct ....
                $dataToUpdate['password'] = \Hash::make($request->get('password'));
            }


            if (empty($dataToUpdate))
				return RESTAPIHelper::response(array(), 'Error', 'Nothing to update');
				

            $user->update($dataToUpdate);


            $userData	=	$user;
			$result = [
				'user_id' => $userData['id'],
				'full_name' => $userData['full_name'],
				'email' => $userData['email'],
				'phone_number' => $userData['phone_number'],
				'address' => $userData['address'],
				'profile_picture' => asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))),
				'_token' => $incomingToken
			];

            $dev_msg = "Password updated successfully";
            return RESTAPIHelper::response( $result ,'Success',$dev_msg);


        } else {
            // if no user object found .....
            return RESTAPIHelper::response(array(), 'Error', 'No User found with Provided User Id');
        }

        //return RESTAPIHelper::emptyResponse();
    } 
    
    
	public function addAddress(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		$blankObject	=	(object)array();

        if(!isset($country_id) || trim($country_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter country_id');
        }
        elseif(!isset($country) || trim($country)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter country');
        }
		elseif(!isset($city_id) || trim($city_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter city_id');
        }
		elseif(!isset($city) || trim($city)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter city');
        }
		elseif(!isset($street_name) || trim($street_name)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter street_name');
        }
		elseif(!isset($building_name) || trim($building_name)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter building_name');
        }
		elseif(!isset($floor) || trim($floor)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter floor');
        }
		elseif(!isset($appartment) || trim($appartment)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter appartment');
        }
		elseif(!isset($nearest_landmark) || trim($nearest_landmark)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter nearest_landmark');
        }
		elseif(!isset($location_type) || trim($location_type)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter location_type');
        }
        elseif(!isset($user_id) || trim($user_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter user_id');
        }
		
		
		$addressAdded	=	Useraddress::create($input);
		
		#DB::table('usercart')->insert($input);

		return RESTAPIHelper::response($addressAdded,'Success', 'Address Added Successfully');
     }
}