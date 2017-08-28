<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\WebContactRequest;
use App\Http\Requests\Frontend\WebJoinRequest;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Hash;
use Auth;
use Gregwar\Image\Image;
use Illuminate\Support\Facades\Session;
use JWTAuth;
use App\Setting;
use App\Useraddress;
use App\Userorder;
use App\Report;
use App\Helpers\RESTAPIHelper;
use Config;
use Validator;
use App\Http\Requests\Frontend\WebLoginRequest;
use App\Http\Requests\Frontend\AddressRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Feedback;
use App\Usercart;
use App\Slider;
use App\Category;
use App\Advertisementimage;

class WebController extends Controller {

    public function login(WebLoginRequest $request) {

        $postData = $request->all();
        //dd($postData['email']);
        $data = User::where('email', $postData['email'])->first();
        if ($data) {
            $check = Hash::check($postData['password'], $data['password']);
            if ($check) {
                $user = User::where('email', $postData['email'])->first();
//                dd($user);
                $request->session()->put('user', $user);
                //session()->flash('alert', 'These credentials do not match our records.');
                return redirect('index');
            } else {

                Session::put('fail', 'Invalid Credentials!');
                return redirect('login');
            }
        } else {
            Session::put('fail', 'Invalid Credentials!');
            return redirect('login');
        }
    }

    public function search(Request $request) {
        $data = $request->all();
        $category = $data['category_id'];
        $Category = Category::where('parent_id', 0)->whereId($category)->with('subcategories.brands')->first();
        $allCategoriesFromDB = Category::where('parent_id', 0)->with('subcategories')->get();
        return frontend_view('categories', compact('Category', 'allCategoriesFromDB'));
    }

    public function sendemail(Request $request) {
        $postData = $request->all();
        $requestuser = User::where('email', $postData['email'])->first();
        if (!$requestuser) {
            return redirect('forgotpassword');
        }
        //dd($requestuser);
        $passwordGenerated = \Illuminate\Support\Str::random(12);

        $requestuser->password = \Hash::make($passwordGenerated);
        $requestuser->save();

        $emailBody = "You have requested to reset a password of your account, please find your new generated password below:

            New Password : " . $passwordGenerated . "

            Thanks.";
        \Mail::raw($emailBody, function($m) use($requestuser) {
            $m->to($requestuser->email)->from(env('MAIL_USERNAME'))->subject('Your password has been reset -Smart Mart');
        });

        return redirect('login');
    }

    public function add(WebJoinRequest $request, User $user) {
        $postData = $request->all();
        //dd($request->hasFile('image'));
        if ($request->has('password') && $request->get('password', '') != '') {
            $postData['password'] = \Hash::make($postData['password']);
        }

        if ($file = $request->hasFile('image')) {


            $file = $request->file('image');

            $fileName = Str::random(12) . '.' . $request->file('image')->getClientOriginalExtension();
            $destinationPath = Config::get('constants.front.dir.profilePicPath');
            $file->move($destinationPath, $fileName);

            if (Image::open($destinationPath . '/' . $fileName)->save($destinationPath . '/' . $fileName)) {
                $postData['image'] = $fileName;
            }
        }
        $user->create($postData);
        return redirect('login');
    }

}
