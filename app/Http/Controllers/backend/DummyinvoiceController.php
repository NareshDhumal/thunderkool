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
use PhpOffice\PhpSpreadsheet\Chart\Chart;

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

        $this->validate($request, [
            'company_id' => 'required',
            'customer_id' => 'required',
            'date_of_issue' => 'before:50 years',
            'payment_method' => 'required'

        ]);

        $invoice_data = $request->all();
        $invoice = new DummyInvoive;
        $invoice->fill($request->all());
        $invoice->save();


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

        $products = $request->products;
        $data = [];

        // $product_name=[];
        if (isset($request->row_counter)) {
            // dd($request->row_counter);
            foreach ($request->row_counter as $row_number) {
                $i = $row_number;
                // for ($i = 0; $i < count($products); $i++) {
                $name = $products[$i]['product_description'];
                //  dd(is_numeric($name));
                if (isset($products[$i]['hsn']) && is_numeric($name) == true) {

                    $p_name = Product::where('product_id', $name)->first();
                    // $data[] = $products[$i];

                    $data[$i]['product_name'] = $p_name->product_name;
                    if (isset($products[$i]['unit'])) {
                        $unit = Unit::where('p_unit_id', $products[$i]['unit'])->first();
                        $data[$i]['product_unit'] = $unit->unit;
                    } else {
                        $data[$i]['product_unit'] = null;
                    }
                    $data[$i]['hsn'] = $products[$i]['hsn'];
                    $data[$i]['quantity'] = $products[$i]['quantity'];;
                    $data[$i]['rate'] = $products[$i]['rate'];
                    $data[$i]['amount'] = $products[$i]['amount'];
                    $data[$i]['discount'] = $products[$i]['discount'];
                    $data[$i]['totalamount'] = $products[$i]['totalamount'];
                } else if (is_numeric($name) == true) {

                    $p_name = Product::where('product_id', $name)->first();
                    $data[$i]['product_name'] = $p_name->product_name;

                    if (isset($products[$i]['unit'])) {
                        $unit = Unit::where('p_unit_id', $products[$i]['unit'])->first();
                        $data[$i]['product_unit'] = $unit->unit;
                    } else {
                        $data[$i]['product_unit'] = null;
                    }
                    $data[$i]['quantity'] = $products[$i]['quantity'];
                    $data[$i]['rate'] = $products[$i]['rate'];
                    $data[$i]['amount'] = $products[$i]['amount'];
                    $data[$i]['discount'] = $products[$i]['discount'];
                    $data[$i]['totalamount'] = $products[$i]['totalamount'];
                    // dd($data);

                } else if (isset($products[$i]['hsn'])) {

                    $data[$i]['product_name'] = $products[$i]['product_description'];
                    $data[$i]['hsn'] = $products[$i]['hsn'];
                    $data[$i]['quantity'] = $products[$i]['quantity'];
                    $unit = Unit::where('p_unit_id', $products[$i]['unit'])->first();
                    $data[$i]['product_unit'] = $unit->unit;
                    $data[$i]['rate'] = $products[$i]['rate'];
                    $data[$i]['amount'] = $products[$i]['amount'];
                    $data[$i]['discount'] = $products[$i]['discount'];
                    $data[$i]['totalamount'] = $products[$i]['totalamount'];
                } else {

                    $data[$i]['product_name'] = $products[$i]['product_description'];
                    $data[$i]['quantity'] = $products[$i]['quantity'];
                    $unit = Unit::where('p_unit_id', $products[$i]['unit'])->first();
                    $data[$i]['product_unit'] = $unit->unit;
                    $data[$i]['rate'] = $products[$i]['rate'];
                    $data[$i]['amount'] = $products[$i]['amount'];
                    $data[$i]['discount'] = $products[$i]['discount'];
                    $data[$i]['totalamount'] = $products[$i]['totalamount'];
                }
                // }
            }
        }





        return view('backend.dummyinvoice.view', compact('invoice_data', 'company_details', 'vehicle_make', 'vehicle_model', 'customers', 'vehicle', 'products', 'data'));
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
