<?php

namespace App\Http\Controllers\Backend;

use Config;

use Illuminate\Http\Request;

// use App\Http\Requests;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
//use Validator;

use App\Feedback;
use App\Subcategory;
use App\Log;
use Illuminate\Support\Facades\DB;
class FeedbackController extends BackendController
{
    public function getIndex()
    {
        
		$allFeedbacks = Feedback::with('user')->get();

        return backend_view( 'feedback.index', compact('allFeedbacks'));
    }


    public function destroy(Feedback $feedback)
    {

        $feedback->delete();

        session()->flash('alert-success', 'Feedback has been deleted successfully!');
        return redirect( 'backend/feedback' );
    }

   
}
