<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Vehicle;
use App\Models\backend\VehicleMake;
use App\Models\backend\Vehiclemodel;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(){
        // $vehicle = Vehicle::all();
        $vehicle = Vehicle::with('make','model')->get();
        return view('backend.vehicle.index',compact('vehicle'));

    }
    public function create(){
        $make = VehicleMake::pluck('vehicle_make_name','vehicle_make_id');
        $model = Vehiclemodel::pluck('vehicle_model_name','vehicle_model_id');
        // dd($model);
        return view('backend.vehicle.create',compact('make','model'));
        
    }

    public function store(request $request){
        // dd($request->all());
        $this->validate($request,[
            'vehicle_make_id' => 'required',
            'vehicle_model_id' => 'required',
            'vehicle_no' => 'required',
            'chassis_no' => 'required',
            'serial_no' => 'required',
            'cab_no' => 'required',
            'loco_no' => 'required'
        ]);

        $vehicle = new Vehicle();
        $vehicle->fill($request->all());
        $vehicle->save();
        return redirect('/admin/vehicle/')->with('success','Vehicle Created successfully');
        
    }

    public function edit($id){
        // $editdata = Vehicle::where('vehicle_id', $id)->first();
        $editdata = Vehicle::where('vehicle_id', $id)->first();
        // dd($editdata->toArray());
        $make = VehicleMake::pluck('vehicle_make_name','vehicle_make_id');
        $model = Vehiclemodel::pluck('vehicle_model_name','vehicle_model_id');

        return view('backend.vehicle.edit',compact('editdata','make','model'));
    }

    public function update(request $request)
    {
        $id = $request->input('vehicle_id');
        $updatedata = Vehicle::findOrFail($id);
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/vehicle/')->with('message','Vehicle Updated successfully');

    }

    public function delete($id)
    {
        $deletedata = Vehicle::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/vehicle/')->with('error','Vehicle Delelted successfully');

    }
}