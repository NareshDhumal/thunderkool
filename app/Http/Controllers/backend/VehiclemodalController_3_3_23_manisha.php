<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Vehiclemodel;
use Illuminate\Http\Request;

class VehiclemodalController extends Controller
{
    public function index(){
        $Vehicle_model = Vehiclemodel::all();
        // dd($Vehicle_model->toArray());
        return view('backend.VehicleModel.index',compact('Vehicle_model'));

    }
    public function create(){

        return view('backend.VehicleModel.create');        
    }

    public function store(request $request){

        $this->validate($request,[
            'vehicle_model_name' => 'required|unique:vehicle_model,vehicle_model_name',
        ]);

        $Vehicle_model = new Vehiclemodel();
        $Vehicle_model->fill($request->all());
        $Vehicle_model->save();
        return redirect('admin/vehiclemodel/')->with('success','VehicleModel Created successfully');
        
    }

    public function edit($id){
        $editdata = Vehiclemodel::where('vehicle_model_id', $id)->first();
        return view('backend.VehicleModel.edit',compact('editdata'));
    }

    public function update(request $request)
    {

        $this->validate($request,[
            'vehicle_model_name' => 'required|unique:vehicle_model,vehicle_model_name',
        ]);

        
        $id = $request->input('vehicle_model_id');
        $updatedata = Vehiclemodel::findOrFail($id);
        // $updatedata = tax::where('tax_id', $id)->first();
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/vehiclemodel')->with('message','VehicleModal updated successfully');

    }

    public function delete($id)
    {
        $deletedata = Vehiclemodel::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/vehiclemodel/')->with('error','VehicleModel Deleted successfully');

    }
}
