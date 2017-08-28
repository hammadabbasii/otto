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

class ItineraryController extends ApiBaseController {

    public function init() {
        return RESTAPIHelper::response([
                    'tutorial_video' => Setting::extract('app.link.tutorial_video', ''),
        ]);
    }

    public function getAllItinerary(Request $request) {
        header('Content-type: application/json');

        $allItineraryFromDB = DB::table('itineraries')->get();

        #Alternatively this can also be used; this is not standard
        #$allItineraryFromDB = Itinerary::all();

        $jsonArray = array();
        $responseArray = array();
        $allItinerary = array();

        foreach ($allItineraryFromDB as $Itinerary) {
            $thisItinerary = array();
            $thisItinerary = $Itinerary;

            $allItinerary[] = $thisItinerary;
        }

        $jsonArray['itineraries'] = $allItinerary;
        return RESTAPIHelper::response($jsonArray, 'Success', 'All Itineraries');
    }

}
