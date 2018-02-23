<?php

/*
 * Home Controller
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['']]);

    }
    
    public function index(Request $request)
    {
        
        $data['keyword'] = '';
        return view('dashboard.index')->with($data);
    }
    
    public function allUsers()
    {
        $data['user']   = Auth::user();
        $data['users']  = User::where('user_type','!=',1)->get();
        return view('dashboard.users')->with($data);
    }
    
    public function myAccount()
    {
        $user = Auth::user();
        
        $data['user'] = $user;
        if ($user->user_type == 1) {
            $companyAdmin = $user->id;
        }
        
        $data['company'] = Company::where('admin', $companyAdmin)->first();
        return view('dashboard.my-account')->with($data);
    }
    
    public function myAccountPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255'
        ]);
        
        $user = User::find(Auth::user()->id);
        $user->name         = $request->input('name');
        $user->email        = $request->input('email');
        $user->first_name   = $request->input('first_name');
        $user->last_name    = $request->input('last_name');
        $user->save();
        
        $companyId = $request->input('company_id');
        if ($companyId) {
            //update
            $company = Company::find($companyId);
            $company->name      = $request->input('company_name');
            $company->phone     = $request->input('phone');
            $company->address   = $request->input('address');
            $company->city      = $request->input('city');
            $company->state     = $request->input('state');
            $company->zip       = $request->input('zip');
            $company->zone      = $request->input('zone');
            $company->save();
        } 
        else {
            //insert
            Company::create([
                'name'      => $request->input('company_name'),
                'phone'     => $request->input('phone'),
                'address'   => $request->input('address'),
                'city'      => $request->input('city'),
                'state'     => $request->input('state'),
                'zip'       => $request->input('zip'),
                'zone'      => $request->input('zone'),
                'admin'     => Auth::user()->id
            ]);

        
        }
        
        $request->session()->flash('success', 'You have successfully updated your account.');
        return redirect('account');
    }
   
}
