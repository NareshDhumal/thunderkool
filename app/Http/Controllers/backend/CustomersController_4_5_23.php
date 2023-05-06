<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Customers;
use App\Models\backend\State;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {

        $Customers = Customers::all();
        return view('backend.customers.index', compact('Customers'));
    }
    public function create()
    {
        $state = State::pluck('state_name', 'state_id');
        // dd($state);
        return view('backend.customers.create', compact('state'));
    }

    public function store(request $request)
    {

        $this->validate($request, [
            'customer_name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'address' => 'required',
            'mobile_no' => 'required|digits:10|regex:/^[6-9]{1}[0-9]{9}$/',
            'email' => 'nullable|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:customers,email',
            'pin_code' => 'required|integer|min:0',
            'state' => 'required',
            // 'c_gst_no' => 'digits:15',
            // 'c_bank_name' => 'required',
            // 'c_branch_name' => 'required',
            // 'c_bank_ifsc' => 'required',
            // 'c_account_no' => 'required|integer|min:0',
            // 'c_pan_no' => 'required',

        ]);

        $Customers = new Customers();
        $Customers->fill($request->all());
        $Customers->save();
        return redirect('/admin/customer')->with('success', 'Customer Created successfully');
    }

    public function edit($id)
    {
        $editdata = Customers::where('customer_id', $id)->first();
        $state = State::pluck('state_name', 'state_id');

        return view('backend.customers.edit', compact('editdata', 'state'));
    }

    public function update(request $request)
    {

        $this->validate($request, [
            'customer_name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'address' => 'required',
            'mobile_no' => 'required|digits:10|regex:/^[6-9]{1}[0-9]{9}$/',
            'email' => 'nullable|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'pin_code' => 'required',
            'state' => 'required',
            // 'c_gst_no' => 'required',
            // 'c_bank_name' => 'required',
            // 'c_branch_name' => 'required',
            // 'c_bank_ifsc' => 'required',
            // 'c_account_no' => 'required|integer|min:0',
            // 'c_pan_no' => 'required',

        ]);

        $id = $request->input('customer_id');
        $updatedata = Customers::findOrFail($id);
        // $updatedata = tax::where('tax_id', $id)->first();
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/customer/')->with('message', 'Customer Updated successfully');
    }

    public function delete($id)
    {
        $deletedata = Customers::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/customer/')->with('error', 'Customer Deleted successfully');
    }
}
