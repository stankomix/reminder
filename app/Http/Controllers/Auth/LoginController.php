<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

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
    
    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            
            //Check user type
            $user = Auth::user();
           
                    
            $request->session()->flash('success', 'Welcome to your dashboard.');
                
            return redirect('/');
                
                
                
            
        } else {
            return redirect::back()->withErrors('Invalid email or password.');
        }
    }
    
    public function logout(Request $request) {
        
        Auth::logout();
         
         return redirect('login');
    }
}
