<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Hash;
use Config;
use JWTAuth;
use App\Country;
use App\City;
use App\Helpers\RESTAPIHelper;


use Illuminate\Support\Facades\DB;

class CountryController extends ApiBaseController {

   public function getCountries(Request $request)
    {
		$input = $request->all();
        extract($input);
        
		$responseArray	=	array();
		$allCountries	 = 	array();
		
		$allCountries	=	Country::all();

        

        $responseArray['Country'] = $allCountries;
        return RESTAPIHelper::response($responseArray, 'Success', 'All Countries');
		
	}
	
	
	public function getCities(Request $request, $countryID)
    {
		$input = $request->all();
        extract($input);
       

        $blankObject = (object) array();

        if (!isset($countryID) || trim($countryID) == '') {
            return RESTAPIHelper::response($blankObject, 'Error', 'Please Enter countryID');
        }
		#print_r($countryID);die();
        
		$responseArray	=	array();
		$allCountries	 = 	array();
		
		$allCountries	 =	City::where('countryID',$countryID)->get();

        #print_r($allCountries);die();

        $responseArray['Cities'] = $allCountries;
        return RESTAPIHelper::response($responseArray, 'Success', 'All Cities');
		
	}



}
