<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Company;
use App\Models\backend\Invoice;
use App\Models\backend\Unit;
use App\Models\backend\ProductInvoice;
use App\Models\backend\ProductChallan;
use App\Models\backend\Customers;
use App\Http\Controllers\Controller;
use App\Models\backend\Product;
use App\Models\backend\Vehicle;
use App\Models\backend\Challan;
use App\Models\backend\VehicleMake;
use App\Models\backend\Vehiclemodel;
use GrahamCampbell\ResultType\Success;

class ChallanController extends Controller
{

    public function index()
    {
        $challan = Challan::orderBy('challan_id', 'DESC')->get();
        $companies = Company::pluck('company_name', 'company_id');
        return view('backend.challan.index', compact('challan', 'companies'));
    }
    public function create()
    {
        $customers = Customers::pluck('customer_name', 'customer_id');
        $companies = Company::pluck('company_name', 'company_id');
        return view('backend.challan.create', compact('companies', 'customers'));
    }

    public function store(request $request)
    {
        dd($request->all());
        $this->validate($request, [
            'company_id' => 'required',
            'customer_id' => 'required',
            'payment_method' => 'required'
        ]);
        if ($request->gst_flag == 0) {
            $challan = new Challan();
            // $invoice->invoice_no = $last_invoice_id;

            $challan->fill($request->all());
            if (!($request->invoice_cum_challan)) {
                $challan->invoice_cum_challan = 0;
            }
            $last_challan = Challan::orderBy('challan_id', 'DESC')->get('challan_id')->toArray();
            $last_challan_id = '0001';
            if ($last_challan) {
                $last_challan_id = $last_challan[0]['challan_id'] + 1;
                $last_challan_id = '000' . $last_challan_id;
                // dd('hello');
            }
            $challan->challan_no = $last_challan_id;
            // $challan->base_amount = $request->total_amount + $request->discount;
            $challan->base_amount = $request->total_amount_all;
            $challan->total_amount = $request->total_amount_all_gst;

            $challan->save();

            // if ($request->product_counter > 0) {
            // for ($i = 0; $i < $request->row_count; $i++) {
            foreach ($request->product_row_counter as $product_row_count) {
                $i = $product_row_count;

                // $counter = $counter + 1;
                $product_id = 'product_description_' . $i;
                // $product_amount = 'product_amount_' . $i;
                $hsn_code = 'hsn_code_' . $i;
                $quantity = 'quantity_' . $i;
                $amount = 'amount_' . $i;
                $p_unit = 'p_unit_' . $i;
                $rate = 'rate_' . $i;
                $discount = 'discount_' . $i;
                $product_total_amount = 'total_amount_' . $i;


                $productChallan = new ProductChallan();
                $productChallan->challan_id = $challan->challan_id;
                $productChallan->product_id = $request->$product_id;
                // $productChallan->product_amount = $request->$product_amount;
                $productChallan->hsn_code = $request->$hsn_code;
                $productChallan->quantity = $request->$quantity;
                $productChallan->p_unit = $request->$p_unit;
                $productChallan->rate = $request->$rate;
                $productChallan->product_amount = $request->$amount;
                $productChallan->discount = $request->$discount;
                $productChallan->product_total_amount = $request->$product_total_amount;
                // dd($productChallan->toArray());

                $productChallan->save();
            }
            // }
        } else {
            // dd($request->all());
            $challan = new Challan();
            $challan->fill($request->all());
            if (!($request->invoice_cum_challan)) {
                $challan->invoice_cum_challan = 0;
            }
            $last_challan = Challan::orderBy('challan_id', 'DESC')->get('challan_id')->toArray();
            $last_challan_id = '0001';
            if ($last_challan) {
                $last_challan_id = $last_challan[0]['challan_id'] + 1;
                $last_challan_id = '000' . $last_challan_id;
                // dd('hello');
            }
            $challan->challan_no = $last_challan_id;
            $challan->base_amount = $request->total_amount_all;
            $challan->total_cgst_percent = $request->total_cgst_all;
            $challan->total_sgst_percent = $request->total_sgst_all;
            $challan->total_igst_percent = $request->total_igst_all;
            $challan->total_amount = $request->total_amount_all_gst;
            $challan->gst_flag = $request->gst_flag;

            if ($request->product_counter > 0) {

                $challan->save();
                // for ($i = 0; $i < $request->row_count; $i++) {
                // }
                if (isset($request->product_row_counter)) {

                    foreach ($request->product_row_counter as $product_row_count) {
                        $i = $product_row_count;

                        // $counter = $counter + 1;
                        $product_id = 'product_description_' . $i;
                        $hsn_code = 'hsn_code_' . $i;
                        $quantity = 'quantity_' . $i;
                        $amount = 'amount_' . $i;
                        $p_unit = 'p_unit_' . $i;
                        $rate = 'rate_' . $i;
                        $cgst_percent = 'cgst_percent_' . $i;
                        $cgst_amount = 'cgst_amount_' . $i;
                        $sgst_percent = 'sgst_percent_' . $i;
                        $sgst_amount = 'sgst_amount_' . $i;
                        $igst_percent = 'igst_percent_' . $i;
                        $igst_amount = 'igst_amount_' . $i;
                        $discount = 'discount_' . $i;
                        $product_total_amount = 'total_amount_' . $i;

                        // adding the products in ProductInvoice table
                        $productChallan = new ProductChallan();
                        $productChallan->challan_id = $challan->challan_id;
                        $productChallan->product_id = $request->$product_id;
                        $productChallan->hsn_code = $request->$hsn_code;
                        $productChallan->quantity = $request->$quantity;
                        $productChallan->p_unit = $request->$p_unit;
                        $productChallan->rate = $request->$rate;
                        $productChallan->product_amount = $request->$amount;
                        $productChallan->cgst_percent = $request->$cgst_percent;
                        $productChallan->cgst_amount = $request->$cgst_amount;
                        $productChallan->sgst_percent = $request->$sgst_percent;
                        $productChallan->sgst_amount = $request->$sgst_amount;
                        $productChallan->igst_percent = $request->$igst_percent;
                        $productChallan->igst_amount = $request->$igst_amount;
                        $productChallan->discount = $request->$discount;
                        $productChallan->product_total_amount = $request->$product_total_amount;

                        // if ($request->$p_unit != '2' || $request->$p_unit != '3') {
                        // Updating the product stock
                        // $product = Product::where('product_id', $request->$product_id)->first();
                        // if ($product) {
                        // dd($product);
                        // $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                        // $product->save();
                        // }
                        // }
                        // dd($productChallan->toArray());
                        $productChallan->save();
                    }
                }
                return redirect()->route('admin.challan.index')->with('success', 'Challan added Successfully');
            } else {
                return redirect()->route('admin.challan.create')->with('error', 'Please Add The Row First');
            }
        }
        return redirect()->route('admin.challan.index')->with('success', 'Challan added Successfully');
    }

    public function edit($id)
    {
        $units = Unit::get();
        $companies = Company::pluck('company_name', 'company_id');
        $customers = Customers::pluck('customer_name', 'customer_id');
        $challan = Challan::with('productsChallan')->where('challan_id', $id)->first();
        // dd($invoice);
        $vehicle_make = Vehicle::with('make')->where('customer_id', $challan->customer_id)->get()->pluck('make.vehicle_make_name', 'vehicle_make_id');
        $total_quantity = 0;
        foreach ($challan->productsChallan as $product) {
            $total_quantity = $total_quantity + $product->quantity;
        }
        $products = Product::where('company_id', $challan->company_id)->get();
        return view('backend.challan.edit', compact('challan', 'companies', 'customers', 'vehicle_make', 'products', 'units', 'total_quantity'));
    }

    public function update(request $request)
    {
        // dd($request->all());
        $edit_counter =  json_decode($request->editData);
        // dd($edit_counter);

        $this->validate($request, [
            'company_id' => 'required',
            'customer_id' => 'required',
            'payment_method' => 'required'
        ]);
        // dd($request->challan_id);
        if ($request->gst_flag == 0) {
            $challan = Challan::where('challan_id', $request->challan_id)->first();

            $challan->fill($request->all());
            if (!($request->invoice_cum_challan)) {
                $challan->invoice_cum_challan = 0;
            }
            // $challan->base_amount = $request->total_amount + $request->discount;
            $challan->base_amount = $request->total_amount_all;
            $challan->total_amount = $request->total_amount_all_gst;
            $challan->save();

            // if ($request->product_counter > 0) {
            ProductChallan::where('challan_id', $request->challan_id)->delete();
            for ($i = 0; $i < $request->row_count; $i++) {

                $product_id = 'product_description_' . $edit_counter->{$i};
                $product_amount = 'product_amount_' . $edit_counter->{$i};
                $hsn_code = 'hsn_code_' .  $edit_counter->{$i};
                $quantity = 'quantity_' .  $edit_counter->{$i};
                $amount = 'amount_' .  $edit_counter->{$i};
                $p_unit = 'p_unit_' .  $edit_counter->{$i};
                $rate = 'rate_' .  $edit_counter->{$i};
                $discount = 'discount_' .  $edit_counter->{$i};
                $product_total_amount = 'total_amount_' .  $edit_counter->{$i};
                $previous_quantity = 'previous_quantity_' . $edit_counter->{$i};

                $productChallan = new ProductChallan();
                $productChallan->challan_id = $challan->challan_id;
                $productChallan->product_id = $request->$product_id;
                // $productChallan->product_amount = $request->$product_amount;

                $productChallan->hsn_code = $request->$hsn_code;
                $productChallan->quantity = $request->$quantity;
                $productChallan->p_unit = $request->$p_unit;
                $productChallan->rate = $request->$rate;
                $productChallan->product_amount = $request->$amount;
                $productChallan->discount = $request->$discount;
                $productChallan->product_total_amount = $request->$product_total_amount;
                $productChallan->save();
            }
            // }
        } else {
            $challan = Challan::where('challan_id', $request->challan_id)->first();
            $challan->fill($request->all());
            if (!($request->invoice_cum_challan)) {
                $challan->invoice_cum_challan = 0;
            }
            $challan->base_amount = $request->total_amount_all;
            $challan->total_cgst_percent = $request->total_cgst_all;
            $challan->total_sgst_percent = $request->total_sgst_all;
            $challan->total_igst_percent = $request->total_igst_all;
            $challan->total_amount = $request->total_amount_all_gst;
            $challan->gst_flag = $request->gst_flag;
            if ($request->row_count > 0) {
                $challan->save();
                ProductChallan::where('challan_id', $request->challan_id)->delete();
                for ($i = 0; $i < $request->row_count; $i++) {
                    $product_id = 'product_description_' . $edit_counter->{$i};
                    $hsn_code = 'hsn_code_' . $edit_counter->{$i};
                    $quantity = 'quantity_' . $edit_counter->{$i};
                    $amount = 'amount_' . $edit_counter->{$i};
                    $p_unit = 'p_unit_' . $edit_counter->{$i};
                    $rate = 'rate_' . $edit_counter->{$i};
                    $cgst_percent = 'cgst_percent_' . $edit_counter->{$i};
                    $cgst_amount = 'cgst_amount_' . $edit_counter->{$i};
                    $sgst_percent = 'sgst_percent_' . $edit_counter->{$i};
                    $sgst_amount = 'sgst_amount_' . $edit_counter->{$i};
                    $igst_percent = 'igst_percent_' . $edit_counter->{$i};
                    $igst_amount = 'igst_amount_' . $edit_counter->{$i};
                    $discount = 'discount_' . $edit_counter->{$i};
                    $product_total_amount = 'total_amount_' . $edit_counter->{$i};
                    // $previous_quantity = 'previous_quantity_' . $edit_counter->{$i};
                    $productChallan = new ProductChallan();

                    // if ($request->$p_unit != '2' || $request->$p_unit != '3') {
                    //     if (isset($request->$previous_quantity)) {
                    //         $product = Product::where('product_id', $request->$product_id)->first();
                    //         if ($product) {
                    //             $product->product_stock = (int)$product->product_stock + (int)$request->$previous_quantity;
                    //             $product->save();
                    //         }
                    //     }
                    //     $product = Product::where('product_id', $request->$product_id)->first();
                    //     if ($product) {
                    //         $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                    //         $product->save();
                    //     }
                    // }

                    $productChallan->challan_id = $challan->challan_id;
                    $productChallan->product_id = $request->$product_id;
                    $productChallan->hsn_code = $request->$hsn_code;
                    $productChallan->quantity = $request->$quantity;
                    $productChallan->p_unit = $request->$p_unit;
                    $productChallan->rate = $request->$rate;
                    $productChallan->product_amount = $request->$amount;
                    $productChallan->cgst_percent = $request->$cgst_percent;
                    $productChallan->cgst_amount = $request->$cgst_amount;
                    $productChallan->sgst_percent = $request->$sgst_percent;
                    $productChallan->sgst_amount = $request->$sgst_amount;
                    $productChallan->igst_percent = $request->$igst_percent;
                    $productChallan->igst_amount = $request->$igst_amount;
                    $productChallan->discount = $request->$discount;
                    $productChallan->product_total_amount = $request->$product_total_amount;
                    $productChallan->save();
                }
                return 'Success';
            } else {
                return 'nosuccess';
            }
        }
        return 'Success';
        // return redirect()->route('admin.invoice.index')->with('success', 'Invoice added Successfully');
    }

    public function view($id)
    {
        // dd('hello');

        $challan = challan::with('productsChallan')->where('challan_id', $id)->first();
        // dd($invoice);
        return view('backend.challan.view', compact('challan'));
    }
    public function delete($id)
    {
        $deletedata = Challan::with('productsChallan')->where('challan_id', $id)->first();
        // if ($deletedata) {
        //     foreach ($deletedata->productsInvoice as $data) {
        //         $product = Product::where('product_id', $data->product_id)->first();
        //         if ($product) {
        //             if ($product->p_unit != '2' || $product->p_unit != '3') {
        //                 if (isset($data->quantity)) {
        //                     $product->product_stock = $product->product_stock + $data->quantity;
        //                     $product->save();
        //                 }
        //             }
        //         }
        //     }
        // }
        if ($deletedata->delete()) {
            ProductChallan::where('challan_id', $id)->delete();
            return redirect()->route('admin.challan.index')->with('success', 'Challan Deleted Successfully');
        } else {
            return redirect()->route('admin.challan.index')->with('error', 'Failed to Delte the Challan');
        }
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
        dd($products->toArray());
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
    // public function getInvoices(Request $request)
    // {
    //     Invoice::where('company_id', $request->company_id)->orderBy('invoice_id', 'DESC')->get();
    // }

}
