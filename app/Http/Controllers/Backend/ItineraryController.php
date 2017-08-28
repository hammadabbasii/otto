<?php

namespace App\Http\Controllers\Backend;

use Config;
use Illuminate\Http\Request;
// use App\Http\Requests;
use App\Http\Requests\Backend\ItineraryRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
//use Validator;
use App\Itinerary;
use App\Log;
use Illuminate\Support\Facades\DB;

class ItineraryController extends BackendController {

    public function getIndex() {
        $itinerary = Itinerary::all();
        
//        print_r($itinerary);
//        die();


        return backend_view('itinerary.index', compact('itinerary'));
    }

    public function edit(Itinerary $itinerary) {
        /* if ( !$user->isAdmin() )
          abort(404); */

        return backend_view('itinerary.edit', compact('itinerary'));
    }

    public function add() {
        return backend_view('itinerary.add');
    }

    public function create(ItineraryRequest $request, Itinerary $itinerary) {
        $postData = $request->all();


        $itinerary->create($postData);

        session()->flash('alert-success', 'Itinerary has been created successfully!');
        return redirect('backend/itinerary/add/' . $itinerary->id);
    }

    public function update(ItineraryRequest $request, Itinerary $itinerary) {


        $postData = $request->all();



        // dd($request);
        $itinerary->update($postData);

        session()->flash('alert-success', 'Itinerary has been updated successfully!');
        return redirect('backend/itinerary/edit/' . $itinerary->id);
    }

    public function destroy(Itinerary $itinerary) {


        $itinerary->delete();

        session()->flash('alert-success', 'Itinerary has been deleted successfully!');
        return redirect('backend/itinerary');
    }

    public function changeStatus(Request $request, $itineraryId) {

        //$userId = $request->input('userId');
        header('Content-type: application/json');
        $allNotificationsFromDB = DB::table('itineraries')->where('id', $itineraryId)->get();

        $allNotificationsFromDB = (array) $allNotificationsFromDB;

        $currentStatus = $allNotificationsFromDB[0]->status;
        if ($currentStatus == '0') {
            DB::table('itineraries')->where('id', $itineraryId)->update(['status' => '1']);
            echo "0";
        } else {
            DB::table('itineraries')->where('id', $itineraryId)->update(['status' => '0']);
            echo "1";
        }
    }

}
