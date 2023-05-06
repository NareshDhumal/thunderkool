<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Tax;
use Illuminate\Http\Request;

class Taxcontroller extends Controller
{
    public function index(){
        $tax = Tax::all();
        // dd($tax);
        return view('backend.tax.index',compact('tax'));

    }
    public function create(){
        
        return view('backend.tax.create');
        
    }

    public function store(request $request){

        $this->validate($request,[
            'gst_name' => 'required|unique:tax,gst_name',
            'gst_value' => 'required|numeric|min:0|unique:tax,gst_value'
        ]);

        $tax = new Tax();
        $tax->fill($request->all());
        $tax->save();
        return redirect('admin/tax/')->with('success','Gst Created Succesfully');
        
    }

    public function edit($id){
        $editdata = Tax::where('gst_id', $id)->first();
        return view('backend.tax.edit',compact('editdata'));
    }

    public function update(request $request)
    {
        $this->validate($request,[
            'gst_name' => 'required',
            'gst_value' => 'required|numeric|min:0'
        ]);

        $id = $request->input('gst_id');
        $updatedata = Tax::findOrFail($id);
        // $updatedata = tax::where('tax_id', $id)->first();
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/tax/')->with('message','Gst Updated succesfully');

    }

    public function delete($id)
    {
        $deletedata = Tax::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/tax/')->with('error','Gst Deleted Succesfully');

    }
}

