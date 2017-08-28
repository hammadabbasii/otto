<?php

namespace App\Http\Controllers\Backend;

use Config;
use Illuminate\Http\Request;
// use App\Http\Requests;
use App\Http\Requests\Backend\AdminRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
//use Validator;
use App\Admin;
use App\Log;
use Illuminate\Support\Facades\DB;

class AdminController extends BackendController {

    public function getIndex() {
        $admins = Admin::where(['role_id' => 1])->where(['userType' => 'subadmin'])->get();
        #
        #$admins =	DB::table('users')->where('role_id', 3)->where('userType','subadmin')->get();

        return backend_view('admins.index', compact('admins'));
    }

    public function edit(Admin $admin) {
        /* if ( !$admin->isAdmin() )
          abort(404); */

        return backend_view('admins.edit', compact('admin'));
    }

    public function add() {
        return backend_view('admins.add');
    }

    public function create(AdminRequest $request, Admin $admin) {
        $postData = $request->all();

        if ($request->has('password') && $request->get('password', '') != '') {
            $postData['password'] = \Hash::make($postData['password']);
        }

        $postData['role_id'] = 1;
        $postData['userType'] = 'subadmin';

        $adminRightsArray = $postData['rights'];
        $adminRightsString = implode(",", $adminRightsArray);

        $postData['rights'] = $adminRightsString;



        $admin->create($postData);

        session()->flash('alert-success', 'Admin has been created successfully!');
        return redirect('backend/admin/add/' . $admin->id);
    }

    public function update(AdminRequest $request, Admin $admin) {
        /* if ( $admin->isAdmin() )
          abort(404); */

        $postData = $request->all();

        if ($request->has('password') && $request->get('password', '') != '') {
            $postData['password'] = \Hash::make($postData['password']);
        }


        if ($file = $request->hasFile('profile_picture')) {

            $file = $request->file('profile_picture');


            $fileName = $admin->id . '-' . \Illuminate\Support\Str::random(12) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            echo $destinationPath = public_path() . '/images/';
            $file->move($destinationPath, $fileName);
            echo $admin->profile_picture = $fileName;
        }

        // dd($request);
        $adminRightsArray = $postData['rights'];
        $adminRightsString = implode(",", $adminRightsArray);
        #print_r($adminRightsString);die();
        $postData['rights'] = $adminRightsString;

        $admin->update($postData);

        #print_r($postData);die();
        $postData['rights'] = $adminRightsArray;

        session()->flash('alert-success', 'Admin has been updated successfully!');
        return redirect('backend/admin/edit/' . $admin->id);
    }

    public function destroy(Admin $admin) {
        /* if ( $admin->isAdmin() )
          abort(404); */

        $admin->delete();

        session()->flash('alert-success', 'Admin has been deleted successfully!');
        return redirect('backend/admin');
    }

    public function profile($id) {
        $admins = Admin::where(['role_id' => Admin::ROLE_MEMBER])->where(['id' => $id])->first()->toArray();
        $adminLogs = Log::with(['admin'])->where(['log_generator' => $id])->get()->toArray();

//dd($adminLogs);
        return backend_view('admins.profile', compact('admins', 'adminLogs'));
    }

}
