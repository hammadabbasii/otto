<?php

namespace App\Http\Controllers\Backend;

use Config;

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Requests\Backend\UserRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
//use Validator;

use App\User;
use App\Log;

use Illuminate\Support\Facades\DB;

class UserController extends BackendController
{
    public function getIndex()
    {
        $users = User::where(['role_id' => User::ROLE_MEMBER])->get();

        return backend_view( 'users.index', compact('users') );
    }

    public function edit(User $user)
    {
        /*if ( !$user->isAdmin() )
            abort(404);*/

        return backend_view( 'users.edit', compact('user') );
    }

    public function add()
    {
            return backend_view( 'users.add' );
    }

    public function create(UserRequest $request,User $user)
    {
        $postData = $request->all();

        if ( $request->has('password') && $request->get('password', '') != '' ) {
            $postData['password'] = \Hash::make( $postData['password'] );
        }

        $postData['role_id'] = User::ROLE_MEMBER;
		
		if($file = $request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture') ;
            $fileName = $user->id . '-' . \Illuminate\Support\Str::random(12) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            echo $destinationPath = public_path().'/images/' ;
            $file->move($destinationPath,$fileName);
           echo $user->profile_picture = $fileName ;
           $postData['profile_picture']= $fileName;
        }




        $user->create( $postData );

        session()->flash('alert-success', 'User has been created successfully!');
        return redirect( 'backend/user/add/' . $user->id );

    }

    public function update(UserRequest $request, User $user)
    {
        if ( $user->isAdmin() )
            abort(404);

        $postData = $request->all();

        if ( $request->has('password') && $request->get('password', '') != '' ) {
            $postData['password'] = \Hash::make( $postData['password'] );
        }


        if($file = $request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture') ;
            $fileName = $user->id . '-' . \Illuminate\Support\Str::random(12) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            echo $destinationPath = public_path().'/images/' ;
            $file->move($destinationPath,$fileName);
           echo $user->profile_picture = $fileName ;
           $postData['profile_picture']= $fileName;
        }

       // dd($request);
        $user->update( $postData );

        session()->flash('alert-success', 'User has been updated successfully!');
        return redirect( 'backend/user/edit/' . $user->id );
    }

    public function destroy(User $user)
    {
		$thisUserId	=	$user->id;
        if ( $user->isAdmin() )
            abort(404);

        $user->delete();
		
		#delete all Association of this user 
		#deleting all association
		DB::table('notifications')->where('user_id', $thisUserId)->delete();
		DB::table('orderitems')->where('user_id', $thisUserId)->delete();
		DB::table('user_address')->where('user_id', $thisUserId)->delete();
		DB::table('orderitems')->where('user_id', $thisUserId)->delete();
		DB::table('favorites')->where('user_id', $thisUserId)->delete();

        session()->flash('alert-success', 'User has been deleted successfully!');
        return redirect( 'backend/user' );
    }

    public function profile($id)
    {

        $users        = User::where(['role_id' => User::ROLE_MEMBER])->where(['id' => $id])->first();

        if($users)  $users  =  $users->toArray();
        return backend_view( 'users.profile', compact('users' ) );
    }
	
	public function changeStatus(Request $request,$userId)
     {
		
        //$userId = $request->input('userId');
        header('Content-type: application/json');
	   $allNotificationsFromDB = DB::table('users')->where('id', $userId)->get();
		
       $allNotificationsFromDB	=	(array)$allNotificationsFromDB;
	   
	   $currentStatus	=	$allNotificationsFromDB[0]->status;	   
	   if($currentStatus==0)
	   {
	   		DB::table('users')->where('id', $userId)->update(['status' => 1]);
	   }
	   else
	   {	DB::table('users')->where('id', $userId)->update(['status' => 0]);	}
	   
		echo $currentStatus;
     }
	 
}
