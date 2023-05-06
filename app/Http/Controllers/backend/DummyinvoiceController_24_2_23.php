<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\Customers;
use App\Models\backend\Invoice;
use App\Models\backend\Product;
use App\Models\backend\Unit;
use App\Models\backend\Vehicle;
use App\Models\backend\VehicleMake;
use App\Models\backend\Vehiclemodel;
use Illuminate\Http\Request;

class DummyinvoiceController extends Controller
{

    public function create()
    {
        $customers = Customers::pluck('customer_name', 'customer_id');
        $companies = Company::pluck('company_name', 'company_id');
        return view('backend.dummyinvoice.create', compact('customers', 'companies'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $invoice_data = $request->all();
        $row = $invoice_data['product'];
        // dd($row[0]['product_description']);
        foreach ($row as $key => $value) {
        }
        // dd($value['product_description']);



        $company_details = Company::where('company_id', $request->company_id)->first();
        $customers = Customers::where('customer_id', $request->customer_id)->first();

        $vehicle_make = VehicleMake::where('vehicle_make_id', $request->vehicle_make_id)->first();
        $vehicle_model = Vehiclemodel::where('vehicle_model_id', $request->vehicle_model_id)->first();


        return view('backend.dummyinvoice.view', compact('invoice_data', 'company_details', 'vehicle_make', 'vehicle_model', 'customers', 'row'));
    }


    public function getCompanyDetails(Request $request)
    {
        $compnay = Company::where('company_id', $request->company_id)->first();
        echo json_encode($compnay);
    }
    public function getCustomerDetails(Request $request)
    {
        $response = array();
        $customer = Customers::where('customer_id', $request->customer_id)->first();
        $vehicle_make = Vehicle::with('make')->where('customer_id', $request->customer_id)->get()->pluck('make.vehicle_make_name', 'vehicle_make_id');
        $response['customer'] = $customer;
        $response['vehicle_make'] = $vehicle_make;
        echo json_encode($response);
    }
    public function getVehicleModel(Request $request)
    {
        $vehicle_model = Vehicle::whereHas('model', function ($q) {
            $q->where('vehicle_make_id', '=', request()->vehicle_make_id);
        })->where('customer_id', $request->customer_id)->get()->pluck('model.vehicle_model_name', 'model.vehicle_model_id');
        echo json_encode($vehicle_model);
    }
    public function getVehicleDetails(Request $request)
    {
        // $request->all();
        $vehicle = Vehicle::where('customer_id', $request->customer_id)->where('vehicle_make_id', $request->vehicle_make_id)->where('vehicle_model_id', $request->vehicle_model_id)->first();
        echo json_encode($vehicle);
    }
    public function getProducts(Request $request)
    {
        // $request->all();
        $products = Product::where('company_id', $request->company_id)->get();
        // dd();
        echo json_encode($products);
    }
    public function getProduct(Request $request)
    {
        // $request->all();
        $product = Product::where('product_id', $request->product_id)->get();
        // dd();
        echo json_encode($product);
    }
    public function getUnits(Request $request)
    {
        // $request->all();
        $units = Unit::get();
        // dd();
        echo json_encode($units);
    }
}
