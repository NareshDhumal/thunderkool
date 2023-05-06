<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Customers;
use App\Models\backend\Vehicle;
use App\Models\backend\VehicleMake;
use App\Models\backend\Vehiclemodel;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index($customer_id)
    {
        // $vehicle = Vehicle::all();
        $vehicle = Vehicle::where('customer_id', $customer_id)->with('make', 'model')->get();

        // dd($vehicle);
        return view('backend.vehicle.index', compact('vehicle', 'customer_id'));
    }
    public function addvehicle($id)
    {
        $make = VehicleMake::pluck('vehicle_make_name', 'vehicle_make_id');
        $model = Vehiclemodel::pluck('vehicle_model_name', 'vehicle_model_id');
        $customer_data = Customers::where('customer_id', $id)->first();
        // dd($customer_data->toArray());


        return view('backend.vehicle.create', compact('make', 'model', 'id', 'customer_data'));
    }

    public function store(request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'vehicle_make_id' => 'required',
            'vehicle_model_id' => 'required',
            // 'vehicle_no' => 'required',
            // 'chassis_no' => 'required',
            // 'serial_no' => 'required',
            // 'cab_no' => 'required',
            // 'loco_no' => 'required'
        ]);

        $vehicle = new Vehicle();
        $vehicle->fill($request->all());
        $vehicle->save();
        return redirect('/admin/vehicle/' . $request->customer_id)->with('success', 'Vehicle Created successfully');
    }

    public function edit($id)
    {
        // $editdata = Vehicle::where('vehicle_id', $id)->first();
        $editdata = Vehicle::where('vehicle_id', $id)->first();
        // dd($editdata->toArray());
        $cutomer_data = Customers::where('customer_id', $editdata->customer_id)->first();

        $make = VehicleMake::pluck('vehicle_make_name', 'vehicle_make_id');
        $vehicle_model = Vehiclemodel::where('vehicle_make_id', $editdata->vehicle_make_id)->pluck('vehicle_model_name', 'vehicle_model_id');

        // dd($vehicle_model);
        return view('backend.vehicle.edit', compact('editdata', 'make', 'id', 'vehicle_model', 'cutomer_data'));
    }

    public function update(request $request)
    {
        $this->validate($request, [
            'vehicle_make_id' => 'required',
            'vehicle_model_id' => 'required',
            // 'vehicle_no' => 'required',
            // 'chassis_no' => 'required',
            // 'serial_no' => 'required',
            // 'cab_no' => 'required',
            // 'loco_no' => 'required'
        ]);

        // dd($request->all());
        $id = $request->input('vehicle_id');
        $updatedata = Vehicle::findOrFail($id);
        // dd($updatedata->toArray());
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/vehicle/' . $request->customer_id)->with('message', 'Vehicle Updated successfully');
    }

    public function delete($id)
    {
        $deletedata = Vehicle::findOrFail($id);
        $cutomer_data = Customers::where('customer_id', $deletedata->customer_id)->first();

        $deletedata->delete();
        return redirect('admin/vehicle/' . $cutomer_data->customer_id)->with('error', 'Vehicle Delelted successfully');
    }


    public function model(Request $request)
    {

        $model = Vehiclemodel::where('vehicle_make_id', $request->make_id)->get();

        // dd($model->toArray());
        // print_r(json_encode($model->toArray()));
        echo json_encode($model);
    }

    public function modeledit(Request $request)
    {
        $v_model = Vehiclemodel::where('vehicle_make_id', $request->make_id)->get();
        echo json_encode($v_model);
    }
}
