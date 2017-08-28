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
use Illuminate\Support\Facades\DB;

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
        extract($input);
		
		/*if(!isset($country_id) || trim($country_id)=='')
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
        }*/
		
		
		
		
        /*$input['password'] = Hash::make($input['password']);
        $input['role_id']  = User::ROLE_MEMBER;*/
		
		$credentialsAray	=	array();
		
		
		$credentialsAray['email']  	   = 	$input['email'];
		$credentialsAray['password']	=	Hash::make($input['password']);
		$credentialsAray['full_name']  	 = 	$input['full_name'];
		//$credentialsAray['address']  		= 	$input['address'];
		$credentialsAray['device_type']   = 	$input['device_type'];
		$credentialsAray['device_token']  = 	$input['device_token'];
		$credentialsAray['role_id']  	   = 	User::ROLE_MEMBER;
		$credentialsAray['phone_number']  = 	$input['phone_number'];
		
		//email,full_name,user_name,gender,device_type,device_token,password
		
		
		#Profile Picture Upload
		if ($request->hasFile('profile_picture')) {
            $imageName = Str::random(12) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $path = public_path(Config::get('constants.front.dir.profilePicPath'));
            $request->file('profile_picture')->move($path, $imageName);

            if (Image::open($path . '/' . $imageName)->scaleResize(200)->save($path . '/' . $imageName)) {
                $credentialsAray['profile_picture'] = $imageName;
            }
        }
		unset($input['email']);
		unset($input['password']);
		unset($input['full_name']);
		//unset($input['postal_code']);
		//unset($input['address']);
		unset($input['device_type']);
		unset($input['device_token']);
		unset($input['profile_picture']);
		unset($input['phone_number']);
		
		
        $userCreated = User::create($credentialsAray);
		
		$user_id		   =	$userCreated['id'];
		
		$input['user_id']  = 	$user_id;
		
		#Adding Address  in DB 
		#$addressAdded	   =	Useraddress::create($input);

        return $this->login($request,'1');
		
    }




    public function login(Request $request,$is_register = '')
    {
		$input = $request->all();
        extract($input);
		
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
            'profile_picture' =>  $userData['profile_picture'],
            '_token'          =>  $token
        ];

        if($is_register)
        {
            $dev_msg = "User register successfully";
        }else{
            $dev_msg = "User Logged In successfully";
        }
		
		if(isset($device_type) || isset($device_token))
        {
			DB::table('users')->where('id', $userData['id'])->update(['device_type' => $device_type,'device_token' => $device_token]);
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
    
    public function selectAddress(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		$blankObject	=	(object)array();

        if(!isset($address_id) || trim($address_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter address_id');
        }
        elseif(!isset($user_id) || trim($user_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter user_id');
        }
		
		
		
		#Marking all addresses as 0; not selected;
		DB::table('user_address')->where('user_id', $user_id)->update(['is_selected' => 0]);
		#Marking this as primary address
		DB::table('user_address')->where('id', $address_id)->update(['is_selected' => 1]);
		
		

		return RESTAPIHelper::response($blankObject,'Success', 'Address Selected Successfully');
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
		/*elseif(!isset($floor) || trim($floor)=='')
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
        }*/
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
		
		$addressAdded['city_id']	=	(int) $addressAdded['city_id'];
		$addressAdded['user_id']	=	(int) $addressAdded['user_id'];

		return RESTAPIHelper::response($addressAdded,'Success', 'Address Added Successfully');
     }
	
	public function editAddress(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		$blankObject	=	(object)array();

        if(!isset($id) || trim($id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter id');
        }
		elseif(!isset($country_id) || trim($country_id)=='')
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
		/*elseif(!isset($floor) || trim($floor)=='')
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
        }*/
		elseif(!isset($location_type) || trim($location_type)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter location_type');
        }
        elseif(!isset($user_id) || trim($user_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter user_id');
        }
		
		
		$thisAddress	 =	Useraddress::find($input['id']);
		$addressAdded	=	$thisAddress->update($input);
		
		#DB::table('usercart')->insert($input);

		return RESTAPIHelper::response($input,'Success', 'Address Added Successfully');
     }

	public function deleteAddress(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		$blankObject	=	(object)array();

        if(!isset($id) || trim($id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter id');
        }
		
		
		$thisAddress	 =	Useraddress::find($input['id']);
		$thisAddress->delete();
		
		#DB::table('usercart')->insert($input);

		return RESTAPIHelper::response($blankObject,'Success', 'Address Deleted Successfully');
     }	 
	 
	public function getAddresses(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		#$blankObject	=	(object)array();
		$blankObject	=	array();

       
        if(!isset($user_id) || trim($user_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter user_id');
        }
		
		
		$addresses	=	Useraddress::where('user_id',$user_id)->get();
		$blankObject['Address']	 =	$addresses;

		return RESTAPIHelper::response($blankObject,'Success', 'Address Added Successfully');
     }
	 
	public function getSelectedAddresses(Request $request)
     {
        $input = $request->all();
        extract($input);
        //$userId = $request->input('userId');

       # header('Content-type: application/json');
		
		#$blankObject	=	(object)array();
		$blankObject	=	array();

       
        if(!isset($user_id) || trim($user_id)=='')
        {
			return RESTAPIHelper::response($blankObject,'Error', 'Please Enter user_id');
        }
		
		
		$addresses	=	Useraddress::where('user_id',$user_id)->where('is_selected',1)->get();
		$blankObject['Address']	 =	$addresses;

		return RESTAPIHelper::response($blankObject,'Success', 'Address Added Successfully');
     }
}