<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use  App\Http\Traits\AuthTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // use AuthenticatesUsers;
    // protected $redirectTo = RouteServiceProvider::HOME;


    use AuthTrait;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function loginForm($type){

        return view('auth.login',compact('type'));
    }

    public function login(Request $request){  // return($request) : token - email - password - type

        if (Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
           return $this->redirect($request);   // chekGuard - redirect($request) from AuthTrait
        }

    }

    public function logout(Request $request,$type)    // لازم نعرف التايب مشان نروح ع جارد مشان نسجل خروج من السشن
    {
        Auth::guard($type)->logout();  // لو انا جاية  من الطلاب سجل خروج من الطالب

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
