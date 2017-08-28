<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\BackendController;

use App\User;

class DashboardController extends BackendController
{
    public function getIndex()
    {
        $totalUsers = User::where(['role_id' => User::ROLE_MEMBER])->count();

        return backend_view( 'dashboard', compact('totalUsers') );
    }
}
