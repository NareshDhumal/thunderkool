<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Auth;
use Hash;
use Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('backend.admin.dashboard');
    }

    public function showLoginForm(){
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email', //|regex:/(.*)@myemail\.com/i
        'password' => 'required|min:6'
      ]);
     
      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
      {
     
        // Session::flash('message', 'Menu added!');
        // Session::flash('status', 'success');

        return redirect()->route('admin.dashboard')->with('success','Login Successfull');
           
            
        }else{
          //  Session::flash('message', 'Wrong Credentials!');
          // dd('ok');
          return redirect('admin/login')->with('error', 'Wrong Credentials!');

        // return back()->withErrors([
        //     'message' => 'The email or password is incorrect, please try again'
        // ]);
      }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
