<?php
namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Hash;
use Config;

use Gregwar\Image\Image;
use JWTAuth;

use App\Helpers\RESTAPIHelper;

use phpDocumentor\Reflection\Types\This;
use Validator;
use Illuminate\Support\Str;

use App\Vehicle;
use App\VehicleImage;
use App\VehicleRequest;
use App\VehicleBidding;
use App\VehicleWatchList;
use App\Notification;
use App\BlockedUser;


class CronController extends ApiBaseController {


    public function index(){

               // $getAllVehicle    = Vehicle::find(11);

                //$data['title'] = 'Audi';
                //$data['status'] = 'published';
               // $getAllVehicle->update($data);

        $this->unblockedUser();
        $this->unholdVehicles();
        $this->biddingPushForVehicles();
        echo "success";

    }


    public function unholdVehicles(){

        $condition['status'] = Vehicle::VEHICLE_STATUS_HOLD;

        $allVehicle        = Vehicle::where($condition)->get();

        foreach ($allVehicle as $vehicle) {

            $hold_type                      = $vehicle['hold_type'];
            $hold_datetime                  = $vehicle['hold_datetime'];

            $hours = $this->getListedHoursExact($hold_datetime);

            $data['status']         = 'published';
            $data['hold_datetime']  = NULL;
            $data['hold_type']      = 'none';

            if( $hold_type == 'manual') {

                if($hours >=2) {

                    $vehicle->update($data);
                }

            }
            else if( $hold_type == 'automatic') {

                if(($hours*60) >= 10 ) {

                    $vehicle->update($data);

                    // unholding an automatically hold car ....

                   $requestData =  VehicleRequest::where('vehicle_id',$vehicle['id'])
                                                 ->where('payment_method','credit')
                                                 ->get()->last();
                    $hours = $this->getListedHoursExact($requestData->created_at);
                    echo $requestTimePassed = ($hours*60);

                    if($requestTimePassed >10 && $requestTimePassed <18 ) {


                        $blockuserData['user_id'] = $requestData['user_id'];
                        $blockuserData['vehicle_id'] = $requestData['vehicle_id'];
                        BlockedUser::create($blockuserData);
                    }
                    //dd($requestData);

                }

            }
        
        }

    }

    public function unblockedUser(){

        $blockedUser = BlockedUser::get();

        foreach ($blockedUser as $buser) {

            $hold_type                          = $buser['created_at'];
            $hoursPassed                   = $this->getListedHours($buser['created_at']);
            if($hoursPassed >= 2) {   $buser->delete();  }


            }
        
    }

    public function biddingPushForVehicles(){


        $statuses                   = array(Vehicle::VEHICLE_STATUS_PENDING);
        $condition['vehicle_type']  = Vehicle::VEHICLE_DROPPEDPRICED_TYPE;

        $vehicles = Vehicle::with('vehicleBidding')->where($condition)->whereIn('status', $statuses)->get();

        //dd($vehicles);
        foreach ($vehicles as $vehicle) {

            $hold_type                      = $vehicle['hold_type'];
            $hold_datetime                  = $vehicle['hold_datetime'];
            $vehicle_type                   = $vehicle['vehicle_type'];
            $price                          = $vehicle['price'];
            $totalReductionAmount           = $vehicle['total_reduction_amount'];
            $reductionDuration              = $vehicle['reduction_duration'];
            $reductionInterval              = $vehicle['reduction_interval'];
            $createdAt                      = $vehicle['created_at'];
            $userId                         = $vehicle['user_id'];

            $hoursPast                      = $this->getListedHours($createdAt);

            if($reductionDuration > $hoursPast ) {

                $intervalToReducePrice      = $reductionDuration/$reductionInterval;

                $perIntervalReduction       = $totalReductionAmount/$intervalToReducePrice;
                $totalAmountToReduce        = $perIntervalReduction*$hoursPast;
                $currentPrice               = $price - $totalAmountToReduce;
                $remainingHours = $reductionDuration - $hoursPast;

                $dateAfter12Hours                   = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $reductionHoursAfter12Hours         = $this->getHours($dateAfter12Hours, $createdAt);
                $totalAmountToReduceIn12Hrs         = $perIntervalReduction*$reductionHoursAfter12Hours;
                $currentPriceAfter12Hours           = $price - $totalAmountToReduceIn12Hrs;

                $timeAfter6Hours                    = date("Y-m-d H:i:s", strtotime('+6 hours'));
                $reductionHoursAfter6Hours          = $this->getHours($timeAfter6Hours, $createdAt);
                $totalAmountToReduceIn6Hrs          = $perIntervalReduction*$reductionHoursAfter6Hours;
                $currentPriceAfter6Hours           = $price - $totalAmountToReduceIn6Hrs;

                $timeAfter1Hour                     = date("Y-m-d H:i:s", strtotime('+1 hours'));
                $reductionHoursAfter1Hour           = $this->getHours($timeAfter1Hour, $createdAt);
                $totalAmountToReduceIn1Hr           = $perIntervalReduction*$reductionHoursAfter1Hour;
                $currentPriceAfter1Hour             = $price - $totalAmountToReduceIn1Hr;

                $timeAfter15min                     = date("Y-m-d H:i:s", strtotime('+15 minutes'));
                $reductionHoursAfter15min           = $this->getHours($timeAfter15min, $createdAt);
                $totalAmountToReduceIn15min         = $perIntervalReduction*$reductionHoursAfter15min;
                $currentPriceAfter15min             = $price - $totalAmountToReduceIn15min;

                $timeAfter5min                     = date("Y-m-d H:i:s", strtotime('+5 minutes'));
                $reductionHoursAfter5min           = $this->getHours($timeAfter5min, $createdAt);
                $totalAmountToReduceIn5min         = $perIntervalReduction*$reductionHoursAfter5min;
                $currentPriceAfter5min             = $price - $totalAmountToReduceIn5min;


                foreach ($vehicle->VehicleBidding as $bidding) {

                    $bidding_amount = $bidding['bidding_amount'];
                    $user_id        = $bidding['user_id'];
                    $vehicle_id     = $bidding['vehicle_id'];

                    $userInfo = User::where('id',$user_id)->first();
                    $device_type ='';

                    if($userInfo) {
                        $device_type    = $userInfo->device_type;
                        $device_token   = $userInfo->device_token;
                    }


                    if ($currentPriceAfter5min <= $bidding_amount) {

                        $notificationInfo = Notification::where('receiver_id', $user_id)->where('action_id', $vehicle_id)->where('duration', '5')->first();

                        if (is_null($notificationInfo)) {
                            

                            $data['message'] = 'Your bidding amount will match in 5 minutes';
                            $data['receiver_id'] = $user_id;
                            $data['sender_id'] = $user_id;

                            $data['action_type'] = 'vehicle';
                            $data['action_id'] = $vehicle_id;
                            $data['duration'] = 5;

                            Notification::create($data);

                            $title = $data['message'];
                            $message = ''; // $vehicle->title.' has been reserved for you';
                            $apsArray = array('alert' => $title, 'message' => $message, 'sound' => 'default');

                            if (!empty($device_type)) {

                                $this->sendPush($device_type, $device_token, $apsArray);
                            }
                            else if ($device_type == 'android') {

                                $apsArray = array('title' => $title, 'message' => $message, 'sound' => 'default');
                                $this->SendPushNotificationAndroid($device_token, $apsArray);

                            }
                        }
                    }
                    else if ($currentPriceAfter15min <= $bidding_amount) {

                        $notificationInfo = Notification::where('receiver_id', $user_id)->where('action_id', $vehicle_id)->where('duration', '15')->first();

                        if (is_null($notificationInfo)) {
                            $data['message'] = 'Your bidding amount will match in 15 minutes';
                            $data['receiver_id'] = $user_id;
                            $data['sender_id'] = $user_id;

                            $data['action_type'] = 'vehicle';
                            $data['action_id'] = $vehicle_id;
                            $data['duration'] = 15;

                            Notification::create($data);

                            $title = $data['message'];
                            $message = ''; // $vehicle->title.' has been reserved for you';
                            $apsArray = array('alert' => $title, 'message' => $message, 'sound' => 'default');

                            if (!empty($device_type)) {

                                $this->sendPush($device_type, $device_token, $apsArray);
                            }
                        }
                    }
                    else if ($currentPriceAfter1Hour <= $bidding_amount) {


                        $notificationInfo = Notification::where('receiver_id', $user_id)->where('action_id', $vehicle_id)->where('duration', '1')->first();


                        if (is_null($notificationInfo)) {

                            $data['message'] = 'your bidding amount will match in 1 hour';
                            $data['receiver_id'] = $user_id;
                            $data['sender_id'] = $user_id;

                            $data['action_type'] = 'vehicle';
                            $data['action_id'] = $vehicle_id;
                            $data['duration'] = 1;

                            Notification::create($data);

                            $title = $data['message'];
                            $message = ''; // $vehicle->title.' has been reserved for you';
                            $apsArray = array('alert' => $title, 'message' => $message, 'sound' => 'default');

                            if (!empty($device_type)) {

                                $this->sendPush($device_type, $device_token, $apsArray);
                            }
                        }
                    }
                    else if ($currentPriceAfter6Hours <= $bidding_amount) {


                        $notificationInfo = Notification::where('receiver_id', $user_id)->where('action_id', $vehicle_id)->where('duration', '6')->first();


                        if (is_null($notificationInfo)) {

                        $data['message'] = 'your bidding amount will match in 6 hour';
                        $data['receiver_id'] = $user_id;
                        $data['sender_id'] = $user_id;

                        $data['action_type'] = 'vehicle';
                        $data['action_id'] = $vehicle_id;
                        $data['duration'] = 6;

                        Notification::create($data);

                        $title = $data['message'];
                        $message = ''; // $vehicle->title.' has been reserved for you';
                        $apsArray = array('alert' => $title, 'message' => $message, 'sound' => 'default');

                        if (!empty($device_type)) {

                            $this->sendPush($device_type, $device_token, $apsArray);
                        }
                    }
                    }
                    else if ($currentPriceAfter12Hours <= $bidding_amount) {

                        $notificationInfo = Notification::where('receiver_id', $user_id)->where('action_id', $vehicle_id)->where('duration', '12')->first();

                        if (is_null($notificationInfo)) {

                        $data['message'] = 'Your bidding amount will match in 12 hour';
                        $data['receiver_id'] = $user_id;
                        $data['sender_id'] = $user_id;

                        $data['action_type'] = 'vehicle';
                        $data['action_id'] = $vehicle_id;
                        $data['duration'] = 12;

                        Notification::create($data);

                        $title = $data['message'];
                        $message = ''; // $vehicle->title.' has been reserved for you';
                        $apsArray = array('alert' => $title, 'message' => $message, 'sound' => 'default');

                            if (!empty($device_type)) {

                                $this->sendPush($device_type, $device_token, $apsArray);
                            }
                        }

                    }
                }

            }

        }

    }

    public function sendPush($type,$token,$apsArray){

        if($type == 'ios') {
            $this->SendPushNotification($token, $apsArray);
        }

    }
    public function getVehiclePrice($hours,$perIntervalReduction,$remainingHours,$currentPrice){

        $newPrice = 0;
        if($remainingHours > $hours) {

            $reductionAmount = $perIntervalReduction*$hours;

            $newPrice = $currentPrice   - $reductionAmount;
        }

        return $newPrice;


    }

    public function getListedHours($date)
    {
        $currentDatetime = date('Y-m-d H:i:s');
        $t1              = StrToTime ( $currentDatetime );
        $t2              = StrToTime ( $date );
        $diff            = $t1 - $t2;
        $hours           = $diff / ( 60 * 60 );
        return floor($hours) ;
    }

    public function getListedHoursExact($date)
    {
        $currentDatetime = date('Y-m-d H:i:s');
        $t1              = StrToTime ( $currentDatetime );
        $t2              = StrToTime ( $date );
        $diff            = $t1 - $t2;
        $hours           = $diff / ( 60 * 60 );
        return $hours ;
    }

    public function getHours($newdate,$date)
    {
        $t1              = StrToTime ( $newdate );
        $t2              = StrToTime ( $date );
        $diff            = $t1 - $t2;
        $hours           = $diff / ( 60 * 60 );
        return floor($hours) ;
    }

    public function priceAfterhrs($date)
    {
        $currentDatetime = date('Y-m-d h:i:s');
        $timeAfter12Hr   = date("Y-m-d H:i:s", strtotime('+12 hours'));

        $t1              = StrToTime ( $currentDatetime );
        $t2              = StrToTime ( $date );
        $diff            = $t1 - $t2;
        $hours           = $diff / ( 60 * 60 );
        return floor($hours) ;
    }

    public function checkBiddingEligibility(Request $request)
    {
        $getAllVehicle    = Vehicle::all()->toArray();

        if($getAllVehicle){

            foreach($getAllVehicle as $vehicle) {

                $differenceHour = floor(round((strtotime(date('Y-m-d h:i:s')) - strtotime($vehicle['created_at'])) / 3600, 1));
                $depricateHour = $differenceHour / $vehicle['depriciation_interval'];
                $currentPrice = $depricateHour * $vehicle['depriciation_amount'];
                $currentPrice = $vehicle['price'] - $currentPrice;


                $getVehicleBid = VehicleBidding::where(array('vehicle_id'=>$vehicle['id']))->get()->toArray();
                foreach($getVehicleBid as $vehicleBid)
                {
                    if($currentPrice <= $vehicleBid['bidding_amount'] ){

                        $data['vehicle_id'] = $vehicleBid['id'];
                        $data['user_id'] = $vehicleBid['user_id'];
                        $data['current_price'] = $vehicleBid['bidding_amount'];

                        $checkAlreadyExist = VehicleRequest::where($data)->get()->toArray();
                        if(!$checkAlreadyExist) {
                            VehicleRequest::create($data);
                        }
                    }
                }

            }

        }

    }


}