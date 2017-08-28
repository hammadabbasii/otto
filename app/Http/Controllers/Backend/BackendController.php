<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use View;

use App\UserEntities;

class BackendController extends Controller
{
    public function getEntity(){

        if (Auth::check()) {
            if (Auth::user()->is_subadmin == 'subadmin') {
                return UserEntities::where(['user_id' => Auth::user()->id])->first();
            }
        }
    }

    public function __construct() {
        View::share ( 'checkEntity', $this->getEntity() );

    }
}
