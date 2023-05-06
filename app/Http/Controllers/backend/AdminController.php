<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\backend\Finalpurchasebill;
use App\Models\backend\Invoice;
use Auth;
use Hash;
use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class AdminController extends Controller
{
  public function index()
  {
    $total_invoice = count(Invoice::get());
    $total_outstanding = Invoice::where('payment_method', '=', 'pending')->sum('total_amount');
    $total_amount = DB::table('invoice')->sum('total_amount');
    $total_purchase = count(Finalpurchasebill::all());


    return view('backend.admin.dashboard', compact('total_invoice', 'total_outstanding', 'total_amount', 'total_purchase'));
  }

  public function showLoginForm()
  {
    return view('backend.auth.login');
  }

  public function login(Request $request)
  {
    // Validate the form data
    $this->validate($request, [
      'email'   => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
      'password' => 'required|min:6'
    ]);

    // Attempt to log the user in
    if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
      // dd('ok');
      // Session::flash('message', 'Menu added!');
      // Session::flash('status', 'success');

      return redirect()->route('admin.dashboard')->with('success', 'Login Successfull');
    } else {
      //  Session::flash('message', 'Wrong Credentials!');
      // dd('notok');
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

  public function forgetpassword()
  {
    return view('backend.adminuser.changepassword');
  }
}
