<?php

/*
 * Home Controller
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

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
        $users = array();
        if (Auth::user()->user_type == 1)
        {
            $users = User::where('user_type','!=',1)->get();
        }
        else {
            $users = User::where('manager',Auth::user()->id)->where('user_type', 3)->get();
        }
        
        $data['users']  = $users;
        return view('dashboard.users')->with($data);
    }
    
    public function editUser($id)
    {
        $data['user']       = User::find($id);
        $data['managers']   = User::where('user_type', 2)->get();
        return view('dashboard.user_edit')->with($data);
    }
    
    public function editUserPost(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255'
        ]);
        
        $user = User::find($id);
        
        $user->first_name   = $request->input('first_name');
        $user->last_name    = $request->input('last_name');
        $user->name         = $request->input('name');
        if (Auth::user()->user_type == 1) {
            $user->manager      = $request->input('manager');
            $user->user_type    = $request->input('user_type');
        }
        $user->save();
        
        $request->session()->flash('success', 'You have successfully updated user account.');
        return back();
    }
    
    public function deleteUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        
        $request->session()->flash('success', 'You have successfully deleted user.');
        return redirect('users');
    }


    public function myAccount()
    {
        $user = Auth::user();
        
        $data['user'] = $user;
        $companyAdmin = '';
        if ($user->user_type == 1) {
            $companyAdmin = $user->id;
        } 
        else {
            $companyAdmin = $user->admin;
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
        
        if (Auth::user()->user_type == 1) {
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
        }
        
        $request->session()->flash('success', 'You have successfully updated your account.');
        return redirect('account');
    }
    
    public function myReports()
    {
        $data['user']   = Auth::user();
        $data['reports']  = Report::where('user', Auth::user()->id)->orderBy('id','desc')->get();
        return view('dashboard.reports')->with($data);
    }
    
    public function reports($id = false)
    {
        $data['loggedUser']   = Auth::user();
        $data['currectUser']         = User::find($id);
        $data['reports']  = Report::select('reports.*')->where('user',$id)->orderBy('reports.id','desc')->get();
        
        return view('dashboard.reports')->with($data);
    }
    
    public function userReports()
    {
        $data['user']   = Auth::user();
        if (Auth::user()->user_type == 1) {
            $reports  = Report::select('reports.*', 'users.*')->leftJoin('users', 'users.id', '=', 'reports.user')->orderBy('reports.id','desc')->get();
        } 
        else {
            $reports  = Report::select('reports.*', 'users.*')->leftJoin('users', 'users.id', '=', 'reports.user')->where('users.manager',Auth::user()->id)->orderBy('reports.id','desc')->get();
        }
        
        $reportsUnique = array();
        $reportsUniqueOut = array();
        foreach ($reports as $report) {
            if (!in_array($report->user, $reportsUnique)) {
                $reportsUniqueOut[] = $report;
                $reportsUnique[] = $report->user;
            }
        }
        $data['reports'] = $reportsUniqueOut;
        
        return view('dashboard.person-reports')->with($data);
    }
    
    public function addReport($id = false)
    {
        $data['user']       = Auth::user();
        $data['current']    = ($id) ? false : true;
        if ($id) {
            $data['report']     = Report::find($id);
            if (strtotime('12:00:00') < strtotime($data['report']->created_at)) {
                $data['current'] = true;
            }
        }
        else {
            $data['report']     = Report::where('created_at', '>=', Carbon::today())->where('user',Auth::user()->id)->first();
        }
        return view('dashboard.add-report')->with($data);
    }
    
    public function addReportPost(Request $request)
    {
        
        $report = Report::where('created_at', '>=', Carbon::today())->where('user',Auth::user()->id)->first();
        if ($report) {
            $report->summary    = $request->input('summary');
            $report->high       = $request->input('high');
            $report->low        = $request->input('low');
            $report->comments   = $request->input('comments');
            $report->save();
        }
        else {
            Report::create([
                'summary'   => $request->input('summary'),
                'high'      => $request->input('high'),
                'low'       => $request->input('low'),
                'comments'  => $request->input('comments'),
                'user'      => Auth::user()->id
            ]);
        }
        
        $request->session()->flash('success', 'Your report successfully saved.');
        return back();
        
    }
   
}
