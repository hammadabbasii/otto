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

class InterestController extends ApiBaseController {

    public function init()
    {
        return RESTAPIHelper::response([
            'tutorial_video' => Setting::extract('app.link.tutorial_video', ''),
        ]);
    }

     
	 public function getAllInterests(Request $request)
     {
        header('Content-type: application/json');

        $allInterestsFromDB = DB::table('interests')->get();

        #Alternatively this can also be used; this is not standard
        #$allInterestsFromDB = Interest::all();

        $jsonArray=array();
        $responseArray=array();
        $allInterests=array();

        foreach($allInterestsFromDB as $Interest)
        {
            $thisInterest	=	array();
            $thisInterest	=	$Interest;

            $allInterests[]	=	$thisInterest;
        }

        $jsonArray['Interests']=$allInterests;
		return RESTAPIHelper::response($jsonArray,'Success', 'All User Interest');

     }


}
