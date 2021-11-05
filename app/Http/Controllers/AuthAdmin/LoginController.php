<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function username()
    {
        return 'email';    
    }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credential = $request->only(['email', 'password']);

        if(Auth::guard('admin')->attempt($credential, $request->remember)) 
        {
            activity()->log(Admin::getUsername($request->email, 'email')->first()->nama . ' telah login');
            
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([$this->username() => [trans('auth.failed')] ]);

    }

    public function logout(Request $request)
    {
        try {
            activity()->log(Auth::guard('admin')->user()->nama . ' telah logout');
        } catch(\Exception $ex) {
            if(!Auth::guard('admin')->check()) {
                return redirect()->route('login');
            } else {
                return redirect()->route('dashboard');
            }
        }

        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
