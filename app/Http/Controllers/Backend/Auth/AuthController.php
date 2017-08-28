<?php

namespace App\Http\Controllers\Backend\Auth;

use Validator;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends BackendController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $loginView           = 'backend.auth.login';
    protected $redirectTo          = 'backend/dashboard';
    protected $redirectAfterLogout = 'backend/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password') + ['role_id' => '1'];
    }

    public function adminLogin(Request $request) {

        if ( $request->isMethod('GET') )
            return $this->showLoginForm();

        return $this->login( $request );
    }
}
