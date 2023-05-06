<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\backend\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class AdminusersController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    // $adminusers = Admin::all();
    // dd($adminusers);
    $adminusers = Admin::with('userrole')->get();

    // dd($adminusers);
    return view('backend.adminuser.index', compact('adminusers'));
    // echo "hello";
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {


    $roles = Role::pluck('name', 'id')->all();
    return view('backend.adminuser.create', compact('roles'));
    // return view('backend.adminuser.create');

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    // dd($request->all());
    $this->validate($request, [
      'name' => 'required|regex:/^[a-zA-Z]+$/u',
      'lastname' => 'required|regex:/^[a-zA-Z]+$/u',
      'email' => ['required', 'email', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', 'unique:admin_users,email'],
      'password' => ['required', 'min:6', 'confirmed'],
    ]);
    $adminuser = new Admin();
    $adminuser->fill($request->all());
    // dd($adminuser);
    if ($adminuser->save()) {

      Session::flash('success', 'User Added!');
      Session::flash('status', 'success');
    }

    return redirect()->route('admin.adminusers');
    // return redirect()->back();


  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function show($id)
  {
    $adminuser = Admin::findOrFail($id);

    return view('backend.adminusers.show', compact('adminuser'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function edit($id)
  {
    $adminuser = Admin::findOrFail($id);
    $roles = Role::pluck('name', 'id')->all();
    return view('backend.adminuser.edit', compact('adminuser', 'roles'));
    // return view('backend.adminuser.edit', compact('adminuser'));

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function update(Request $request)
  {
    // echo "<pre>";print_r($request->all());exit;
    $id = $request->input('id');
    $this->validate($request, [
      'name' => 'required|regex:/^[a-zA-Z]+$/u',
      'lastname' => 'required|regex:/^[a-zA-Z]+$/u',
      'email' => ['required', 'email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', Rule::unique(Admin::class, 'email')->ignore($id, 'id')],
      // 'password' => ['required', 'min:6'],
    ]);
    $adminuser = Admin::findOrFail($id);
    if ($adminuser->update($request->all())) {
      // $adminuser->assignRole($request->input('role'));
      // $cat = AdminUsers::Where('category_id',$adminuser->category_id)->first();
      // $cat->category_slug = str_slug($adminuser->category_name );
      // $cat->save();
    }
    Session::flash('message', 'User updated!');
    Session::flash('status', 'success');

    return redirect('admin/adminusers');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function destroy($id)
  {
    $adminuser = Admin::findOrFail($id);

    $adminuser->delete();

    Session::flash('error', 'User deleted!');
    Session::flash('status', 'success');

    return redirect('admin/adminusers');
  }

  public function editstatus($id)
  {
    $adminuser = Admin::findOrFail($id);
    return view('backend.adminuser.edit', compact('adminuser'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   *
   * @return Response 
   */
  public function updatestatus(Request $request)
  {
    // dd($request->all());
    //  echo "<pre>";print_r($request->all());exit;
    $id = $request->input('id');
    $this->validate($request, [
      'id' => ['required'],
      'account_status' => ['required'],
    ]);
    $adminuser = Admin::findOrFail($id);
    // dd($adminuser);
    // dd($request->account_status);
    //     $adminuser = explode(" ", $request->account_status );
    // if( $adminuser->save())
    if ($adminuser->fill($request->all())->save()) {

      // dd($adminuser->account_status);
      return redirect('admin/adminusers')->with('success', 'Status Updated!');
    } else {
      return back()->with('error', 'Something Went Wrong!');
    }
  }
}
