<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\State;
use App\Models\backend\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suplier = Supplier::all();
        // dd($suplier->toArray());
        return view('backend.supplier.index', compact('suplier'));
    }
    public function create()
    {
        $state_data = State::pluck('state_name', 'state_id');
        return view('backend.supplier.create', compact('state_data'));
    }

    public function store(request $request)
    {

        // dd($request->all());
        $this->validate($request, [
            's_name' => 'required|regex:/^[a-zA-Z\s]*$/',
            's_email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:supplier,s_email',
            's_mobile_no' => 'required|digits:10|regex:/^[6-9]{1}[0-9]{9}$/',
            's_address' => 'required',
            // 's_gstno' => 'required',
            's_pin_code' => 'required|numeric|min:0',
            's_state' => 'required',
            // 's_bank_name' => 'required',
            // 's_branch_name' => 'required',
            // 's_account_no' => 'required|numeric|min:0',
            // 's_bank_ifsc' => 'required',
            // 's_pan_no' => 'required',

        ]);

        $financial = new Supplier();
        $financial->fill($request->all());
        $financial->save();
        return redirect('admin/supplier/')->with('success', 'Supplier Created successfully');
    }

    public function edit($id)
    {
        $editdata = Supplier::where('supplier_id', $id)->first();
        $state_data = State::pluck('state_name', 'state_id');

        return view('backend.supplier.edit', compact('editdata', 'state_data'));
    }

    public function update(request $request)
    {
        $this->validate($request, [
            's_name' => 'required|regex:/^[a-zA-Z\s]*$/',
            's_email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            's_mobile_no' => 'required|digits:10||regex:/^[6-9]{1}[0-9]{9}$/',
            's_address' => 'required',
            // 's_gstno' => 'required',
            's_pin_code' => 'required|numeric|min:0',
            's_state' => 'required',
            // 's_bank_name' => 'required',
            // 's_branch_name' => 'required',
            // 's_account_no' => 'required|numeric|min:0',
            // 's_bank_ifsc' => 'required',
            // 's_pan_no' => 'required',

        ]);

        $id = $request->input('supplier_id');
        $updatedata = Supplier::findOrFail($id);
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/supplier/')->with('message', 'Supplier Updated successfully');
    }

    public function delete($id)
    {
        $deletedata = Supplier::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/supplier/')->with('error', 'Supplier Deleted successfully');
    }
}
