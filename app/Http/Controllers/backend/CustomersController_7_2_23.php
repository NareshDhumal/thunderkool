<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Customers;
use App\Models\backend\State;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(){

        $Customers = Customers::all();
        return view('backend.customers.index',compact('Customers'));

    }
    public function create(){
        $state = State::pluck('state_name','state_id');
        // dd($state);
        return view('backend.customers.create',compact('state'));
        
    }

    public function store(request $request){

        $this->validate($request,[
            'customer_name' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'pin_code' => 'required',
            'state' => 'required',
            // 'c_gst_no' => 'required',
            'c_bank_name' => 'required',
            'c_branch_name' => 'required',
            'c_bank_ifsc' => 'required',
            'c_account_no' => 'required',
            'c_pan_no' => 'required',

        ]);

        $Customers = new Customers();
        $Customers->fill($request->all());
        $Customers->save();
        return redirect('/admin/customer');
        
    }

    public function edit($id){
        $editdata = Customers::where('customer_id', $id)->first();
        $state = State::pluck('state_name','state_id');

        return view('backend.customers.edit',compact('editdata','state'));
    }

    public function update(request $request)
    {
        $id = $request->input('customer_id');
        $updatedata = Customers::findOrFail($id);
        // $updatedata = tax::where('tax_id', $id)->first();
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/customer/');

    }

    public function delete($id)
    {
        $deletedata = Customers::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/customer/');

    }
}
