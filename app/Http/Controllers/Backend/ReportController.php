<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Requests\Backend\UserRequest;
use App\Http\Controllers\Backend\BackendController;
use Illuminate\Support\Facades\DB;
use App\Report;
use App\User;


class ReportController extends BackendController
{
    public function getIndex()
    {
        //$reports = Report::get();

        $reports = DB::select("SELECT * from users us join reports rp on us.id = rp.user_id ");

        return backend_view( 'reports.index', compact('reports') );
    }

    /*public function edit(User $user)
    {
        if ( $user->isAdmin() )
            abort(404);

        return backend_view( 'users.edit', compact('user') );
    }

    public function update(UserRequest $request, User $user)
    {
        if ( $user->isAdmin() )
            abort(404);

        $postData = $request->all();

        if ( $request->has('password') && $request->get('password', '') != '' ) {
            $postData['password'] = \Hash::make( $postData['password'] );
        }

        $user->update( $postData );

        session()->flash('alert-success', 'User has been updated successfully!');
        return redirect( 'backend/user/edit/' . $user->id );
    }*/

    public function destroy(Report $report)
    {
        $report->delete();

        session()->flash('alert-success', 'Report has been deleted successfully!');
        return redirect( 'backend/report' );
    }
}
