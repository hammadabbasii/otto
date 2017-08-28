<?php

namespace App\Http\Controllers\Backend;

use Config;

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Requests\Backend\TripRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
//use Validator;

use App\Trip;
use App\Tripuser;
use App\Interest;
use App\Log;

use Illuminate\Support\Facades\DB;

class TripController extends BackendController
{
    public function getIndex()
    {
        $trips = Trip::with('creator')->with('itinerary')->get();
		$allTrips	=	array();
		foreach ($trips as $eachTripInstance) {
                $userData = $eachTripInstance['creator'];

                $thisUserObject = array('user_id' => $userData['id'], 'first_name' => $userData['first_name'], 'last_name' => $userData['last_name'],
                    'email' => $userData['email'], 'gender' => $userData['state'], 'phone' => $userData['phone_number'], 'address' => $userData['address'], 'profile_picture' => asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))));
                unset($eachTripInstance['creator']);
                $eachTripInstance['creator'] = $thisUserObject;

                $allTrips[] = $eachTripInstance;
            }
		$trips	=	$allTrips;
        return backend_view( 'trips.index', compact('trips') );
    }

    public function edit(Trip $trip)
    {
        /*if ( !$trip->isAdmin() )
            abort(404);*/

        return backend_view( 'trips.edit', compact('trip') );
    }

    public function add()
    {
            return backend_view( 'trips.add' );
    }

   

    public function update(TripRequest $request, Trip $trip)
    {
        if ( $trip->isAdmin() )
            abort(404);

        $postData = $request->all();

        if ( $request->has('password') && $request->get('password', '') != '' ) {
            $postData['password'] = \Hash::make( $postData['password'] );
        }


        if($file = $request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture') ;
            $fileName = $trip->id . '-' . \Illuminate\Support\Str::random(12) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            echo $destinationPath = public_path().'/images/' ;
            $file->move($destinationPath,$fileName);
           echo $trip->profile_picture = $fileName ;
           $postData['profile_picture']= $fileName;
        }

       // dd($request);
        $trip->update( $postData );

        session()->flash('alert-success', 'Trip has been updated successfully!');
        return redirect( 'backend/trip/edit/' . $trip->id );
    }

    public function destroy(Trip $trip)
    {
        if ( $trip->isAdmin() )
            abort(404);

        $trip->delete();

        session()->flash('alert-success', 'Trip has been deleted successfully!');
        return redirect( 'backend/trip' );
    }

    
	
	public function changeStatus(Request $request,$tripId)
     {
		
        //$tripId = $request->input('tripId');
        header('Content-type: application/json');
	   $allNotificationsFromDB = DB::table('trips')->where('id', $tripId)->get();
		
       $allNotificationsFromDB	=	(array)$allNotificationsFromDB;
	   
	   $currentStatus	=	$allNotificationsFromDB[0]->status;	   
	   if($currentStatus==0)
	   {
	   		DB::table('trips')->where('id', $tripId)->update(['status' => 1]);
	   }
	   else
	   {	DB::table('trips')->where('id', $tripId)->update(['status' => 0]);	}
	   
		echo $currentStatus;
     }
	 
	 
	 public function getJoinees(Request $request,$tripId)
     {
        //$tripId = $request->input('tripId');
       header('Content-type: application/json');
	   $tripJoinees        =  Tripuser::where(['trip_id' => $tripId])->where(['status' => 1])->with('joinee')->get();
	   if($tripJoinees)
			{$tripJoinees  =  $tripJoinees->toArray();}
			
	   $allUsers	=	array();
		foreach ($tripJoinees as $eachTripInstance) {
                $userData = $eachTripInstance['joinee'];

                $thisUserObject = array('user_id' => $userData['id'], 'first_name' => $userData['first_name'], 'last_name' => $userData['last_name'], 'last_name' => $userData['full_name'],
                    'email' => $userData['email'], 'gender' => $userData['state'], 'phone' => $userData['phone_number'], 'address' => $userData['address'], 'profile_picture' => asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))));
                unset($eachTripInstance['creator']);
                $eachTripInstance['creator'] = $thisUserObject;

                $allUsers[] = $thisUserObject;
            }
		#$trips	=	$allTrips;
	   
	   
		echo json_encode($allUsers);
     }
	 
	 public function getPendings(Request $request,$tripId)
     {
        //$tripId = $request->input('tripId');
       header('Content-type: application/json');
	   $tripJoinees        =  Tripuser::where(['trip_id' => $tripId])->where(['status' => 0])->with('joinee')->get();
	   if($tripJoinees)
			{$tripJoinees  =  $tripJoinees->toArray();}
			
	   $allUsers	=	array();
		foreach ($tripJoinees as $eachTripInstance) {
                $userData = $eachTripInstance['joinee'];

                $thisUserObject = array('user_id' => $userData['id'], 'first_name' => $userData['first_name'], 'last_name' => $userData['last_name'], 'last_name' => $userData['full_name'],
                    'email' => $userData['email'], 'gender' => $userData['state'], 'phone' => $userData['phone_number'], 'address' => $userData['address'], 'profile_picture' => asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))));
                unset($eachTripInstance['creator']);
                $eachTripInstance['creator'] = $thisUserObject;

                $allUsers[] = $thisUserObject;
            }
		#$trips	=	$allTrips;
	   
	   
		echo json_encode($allUsers);
     }
	 
	 public function getRejected(Request $request,$tripId)
     {
        //$tripId = $request->input('tripId');
       header('Content-type: application/json');
	   $tripJoinees        =  Tripuser::where(['trip_id' => $tripId])->where(['status' => 2])->with('joinee')->get();
	   if($tripJoinees)
			{$tripJoinees  =  $tripJoinees->toArray();}
			
	   $allUsers	=	array();
		foreach ($tripJoinees as $eachTripInstance) {
                $userData = $eachTripInstance['joinee'];

                $thisUserObject = array('user_id' => $userData['id'], 'first_name' => $userData['first_name'], 'last_name' => $userData['last_name'], 'last_name' => $userData['full_name'],
                    'email' => $userData['email'], 'gender' => $userData['state'], 'phone' => $userData['phone_number'], 'address' => $userData['address'], 'profile_picture' => asset('public/' . Config::get('constants.front.dir.profilePicPath') . ($userData['profile_picture'] ?: Config::get('constants.front.default.profilePic'))));
                unset($eachTripInstance['creator']);
                $eachTripInstance['creator'] = $thisUserObject;

                $allUsers[] = $thisUserObject;
            }
		#$trips	=	$allTrips;
	   
	   
		echo json_encode($allUsers);
     }
	 
	 public function tripDetails($id)
    {

        $trips        = Trip::where(['id' => $id])->with('creator')->with('interests')->with('itinerary')->with('users')->first();
		if($trips)
			{$trips  =  $trips->toArray();}
		
		#allInterests From DB and setting indexed names
		$allInterests = Interest::all();
		$allInterestsFromDB	=	$allInterests->toArray();
		$allInterestsArray	 =	array();
		foreach($allInterestsFromDB as $eachInterest)
		{
			$thisInterestId	=	$eachInterest['id'];
			$allInterestsArray[$thisInterestId]	=	$eachInterest;
			
		}
		
		$allTripJoinees			=	array();
		$allTripJoineesAccepted	=	array();
		$allTripJoineesRejected	=	array();
		$allTripJoineesPending	 =	array();
		foreach($trips['users'] as $eachTripJoinee)
		{
			$joinStatus	=	$eachTripJoinee['status'];
			
			if($joinStatus=='0' || $joinStatus==0)
				{$allTripJoineesPending[]	= 	$eachTripJoinee['user_id'];}
			elseif($joinStatus=='1' || $joinStatus==1)
				{$allTripJoineesAccepted[]	= 	$eachTripJoinee['user_id'];}
			elseif($joinStatus=='2' || $joinStatus==2)
				{$allTripJoineesRejected[]	= 	$eachTripJoinee['user_id'];}
			
		}
		
		$allTripJoinees['Accepted']	=	$allTripJoineesAccepted; 
		$allTripJoinees['Rejected']	=	$allTripJoineesRejected; 
		$allTripJoinees['Pending']	 =	$allTripJoineesPending; 
        
        return backend_view( 'trips.details', compact('trips','allInterestsArray','allTripJoinees' ) );
    }
}
