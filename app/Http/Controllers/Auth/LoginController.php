<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Spatie\Activitylog\LogsActivity;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use LogsActivity;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function doLogin(Request $request) {
        \Activity::log('Users Trying to login with credentials' . json_encode( $request->all()));
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ( 'magic' === $request->password ) {
            \Activity::log('Users LoggedIn to portal using credentials' . json_encode( $request->all()));
            return redirect('/currency/conversion' );    
        } else {
            return \Redirect::back()->withErrors( ['password' => 'Password is incorrect'] );
        }
    }
}
