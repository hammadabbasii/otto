<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Requests\Backend\PushNotificationRequest;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Controllers\Backend\BackendController;
use Illuminate\Support\Facades\Auth;
//use Validator;

use App\Cms;
use App\User;

class PushNotificationController extends BackendController
{
    public function getIndex()
    {
        $pages = Cms::all();

        return backend_view( 'cms.index', compact('pages') );
    }

    public function edit($page_id)
    {
        $cms = CMS::find($page_id);
        return backend_view( 'cms.edit', compact('cms') );
    }

    public function add()
    {
            return backend_view( 'push.add' );
    }

    public function sendNotification(PushNotificationRequest $request)
    {

        $postData = $request->all();

        if(empty($postData['uids'])) {

            session()->flash('alert-warning', 'Select atleast one user');
            return redirect( 'backend/push/send/');
        }

        $users = User::find($postData['uids'])->toArray();

        foreach($users as $user) {

            $notificationStatus =  $user['notification_status'];
            $deviceType         =  $user['device_type'];
            $deviceToken        =  $user['device_token'];

            if($notificationStatus == 1) {

                $this->pushNotification($deviceType,$deviceToken);
            }

        }


        session()->flash('alert-success', 'Notification has been sent successfully!');
        return redirect( 'backend/push/send/');

    }

    public function update(CmsRequest $request ,$page_id )
    {

        $cms = CMS::find($page_id);
        $postData = $request->all();


        $cms->update( $postData );

        session()->flash('alert-success', 'Page has been updated successfully!');
        return redirect( 'backend/cms/');
    }

    public function destroy($page_id)
    {
        Cms::destroy($page_id);
        session()->flash('alert-success', 'Page has been deleted successfully!');
        return redirect( 'backend/cms' );
    }
}
