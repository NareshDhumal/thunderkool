<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\VehicleMake;
use Illuminate\Http\Request;

class VechlemakeController extends Controller
{
    public function index(){
        $vehicle_make = VehicleMake::orderBy('vehicle_make_id','asc')->get()->sortBy('vehicle_make_name');
        return view('backend.vehiclemake.index',compact('vehicle_make'));

    }
    public function create(){
        
        return view('backend.vehiclemake.create');
        
    }

    public function store(request $request){

        $this->validate($request,[
            'vehicle_make_name' => 'required|regex:/^[a-zA-Z\s]*$/|unique:vehicle_make,vehicle_make_name',
        ]);

        $vehicle_make = new VehicleMake();
        $vehicle_make->fill($request->all());
        $vehicle_make->save();
        return redirect('admin/vehiclemake/')->with('success','VehicleMake Created successfully');
        
    }

    public function edit($id){
        $editdata = VehicleMake::where('vehicle_make_id', $id)->first();
        return view('backend.vehiclemake.edit',compact('editdata'));
    }

    public function update(request $request)
    {
        $this->validate($request,[
            'vehicle_make_name' => 'required|regex:/^[a-zA-Z\s]*$/',
        ]);
        
        $id = $request->input('vehicle_make_id');
        $updatedata = VehicleMake::findOrFail($id);
        // $updatedata = tax::where('tax_id', $id)->first();
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/vehiclemake/')->with('message','VehicleMake Updated successfully');

    }

    public function delete($id)
    {
        $deletedata = VehicleMake::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/vehiclemake/')->with('error','VehicleMake Deleted successfully');

    }
}

