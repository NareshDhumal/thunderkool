<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\Customers;
use App\Models\backend\DummyInvoive;
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
        $invoice = new DummyInvoive;
        $invoice->fill($request->all());
        $invoice->save();

        // $row = $invoice_data['product'];
        // dd($row[0]['product_description']);
        // foreach ($row as $key => $value) {
        // } 
        // dd($value['product_description']);



        $company_details = Company::where('company_id', $request->company_id)->first();

        $customers = Customers::where('customer_id', $request->customer_id)->first();

        $vehicle_make = VehicleMake::where('vehicle_make_id', $request->vehicle_make_id)->first();
        $vehicle_model = Vehiclemodel::where('vehicle_model_id', $request->vehicle_model_id)->first();

        $vehicle = Vehicle::where('customer_id', $request->customer_id)->where(
            'vehicle_make_id',
            $request->vehicle_make_id
        )->where('vehicle_model_id', $request->vehicle_model_id)->first();


        $words = ['product_descrip'];
        $others = $request->all();
        // dd($others);

        // $matched_words = array_filter($words, function ($w) use ($others) {
        //     return preg_grep("/" . $w . "/", $others);
        // });
        // $prod_id_names = [];
        // $keys = array_keys($request->all());
        // for ($i = 0; $i < sizeof($request->all()); $i++) {
        //     if (substr($keys[$i], 0, 19) == 'product_description') {
        //         ///   echo "<br>".$keys[$i];
        //         //  echo $request->$keys[$i];
        //         $prod_id_names[] = $keys[$i];
        //     }
        // }
        // // dd();
        // $product=[];
        // for ($j = 0; $j < count($prod_id_names); $j++) {
        //     // echo $request[$prod_id_names[$j]] . "<br>";
        //     $product[] = Product::where('product_id',$request[$prod_id_names[$j]])->first();
        //     // dd($product->toArray());
        // }

        $products = $request->products;
        $data = [];


        // $product_name=[];
        for ($i = 0; $i < count($products); $i++) {
            $name = $products[$i]['product_description'];

            $p_name = Product::where('product_id', $name)->first();

            $data[] = $products[$i];
            $data[$i]['product_name'] = $p_name->product_name;
            $data[$i]['product_unit'] = $p_name->product_unit;

        }

       


        return view('backend.dummyinvoice.view', compact('invoice_data', 'company_details', 'vehicle_make', 'vehicle_model', 'customers', 'vehicle', 'products','data'));
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
