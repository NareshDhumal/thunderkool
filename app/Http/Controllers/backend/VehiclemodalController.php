<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\VehicleMake;
use App\Models\backend\Vehiclemodel;
use Illuminate\Http\Request;

class VehiclemodalController extends Controller
{
    public function index($make_id){
        $Vehicle_model = Vehiclemodel::where('vehicle_make_id',$make_id)->get()->sortBy('vehicle_model_name');
        // dd($Vehicle_model->toArray());
        // dd($Vehicle_model->toArray());
        return view('backend.VehicleModel.index',compact('Vehicle_model','make_id'));

    }
    public function addmodel($make_id){
        // dd($make_id);
        return view('backend.VehicleModel.create',compact('make_id'));        
    }

    public function store(request $request){
        // dd($request->all());
        $this->validate($request,[
            'vehicle_model_name' => 'required|regex:/^[a-zA-Z0-9\-\s]+$/|unique:vehicle_model,vehicle_model_name',
        ]);

        $Vehicle_model = new Vehiclemodel();
        $Vehicle_model->fill($request->all());
        $Vehicle_model->save();
        return redirect('admin/vehiclemodel/'.$request->vehicle_make_id)->with('success','VehicleModel Created successfully');
        
    }

    public function edit($id){

        $editdata = Vehiclemodel::where('vehicle_model_id', $id)->first();
        // dd($editdata->toArray());
        
        return view('backend.VehicleModel.edit',compact('editdata','id'));
    }

    public function update(request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'vehicle_model_name' => 'required|regex:/^[a-zA-Z0-9\-\s]+$/',
        ]);

        
        $id = $request->input('vehicle_model_id');
        $updatedata = Vehiclemodel::findOrFail($id);
        // $updatedata = tax::where('tax_id', $id)->first();
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/vehiclemodel/'. $request->vehicle_make_id)->with('message','VehicleModal updated successfully');

    }

    public function delete($id)
    {
        $deletedata = Vehiclemodel::findOrFail($id);

        $vehicle_make= Vehiclemodel::where('vehicle_model_id',$deletedata->vehicle_model_id)->first();
        // dd($vehicle_make->toArray());
        $deletedata->delete();

        return redirect('admin/vehiclemodel/'.$vehicle_make->vehicle_make_id)->with('error','VehicleModel Deleted successfully');

    }
}
