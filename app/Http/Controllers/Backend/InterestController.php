<?php

namespace App\Http\Controllers\Backend;

use Config;

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Requests\Backend\InterestRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
//use Validator;

use App\Interest;
use App\Log;
use Illuminate\Support\Facades\DB;
class InterestController extends BackendController
{
    public function getIndex()
    {
        $interest = Interest::all();
		

        return backend_view( 'interest.index', compact('interest') );
    }

    public function edit(Interest $interest)
    {
        /*if ( !$user->isAdmin() )
            abort(404);*/

        return backend_view( 'interest.edit', compact('interest') );
    } 

    public function add()
    {
            return backend_view( 'interest.add' );
    }

    public function create(InterestRequest $request,Interest $interest)
    {
        $postData = $request->all();


        $interest->create( $postData );

        session()->flash('alert-success', 'Interest has been created successfully!');
        return redirect( 'backend/interest/add/' . $interest->id );

    }

    public function update(InterestRequest $request, Interest $interest)
    {
       

        $postData = $request->all();

        

       // dd($request);
        $interest->update( $postData );

        session()->flash('alert-success', 'Interest has been updated successfully!');
        return redirect( 'backend/interest/edit/' . $interest->id );
    }

    public function destroy(Interest $interest)
    {
        

        $interest->delete();

        session()->flash('alert-success', 'Interest has been deleted successfully!');
        return redirect( 'backend/interest' );
    }

   
	public function changeStatus(Request $request,$interestId)
     {
		
        //$userId = $request->input('userId');
        header('Content-type: application/json');
	   $allNotificationsFromDB = DB::table('interests')->where('id', $interestId)->get();
		
       $allNotificationsFromDB	=	(array)$allNotificationsFromDB;
	   
	   $currentStatus	=	$allNotificationsFromDB[0]->status;	   
	   if($currentStatus=='0')
	   {
	   		DB::table('interests')->where('id', $interestId)->update(['status' => '1']);
			echo "0";
			
	   }
	   else
	   {	
			DB::table('interests')->where('id', $interestId)->update(['status' => '0']);	
			echo "1";
		}
	   
		
     }
}
