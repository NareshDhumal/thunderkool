<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Company;
use App\Models\backend\Invoice;
use App\Models\backend\Unit;
use App\Models\backend\ProductInvoice;
use App\Models\backend\Customers;
use App\Http\Controllers\Controller;
use App\Models\backend\Product;
use App\Models\backend\Vehicle;
use App\Models\backend\VehicleMake;
use App\Models\backend\Vehiclemodel;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::orderBy('invoice_id', 'DESC')->get();
        $companies = Company::pluck('company_name', 'company_id');
        return view('backend.invoice.index', compact('invoice', 'companies'));
    }
    public function create()
    {
        $customers = Customers::pluck('customer_name', 'customer_id');
        $companies = Company::pluck('company_name', 'company_id');
        return view('backend.invoice.create', compact('companies', 'customers'));
    }

    public function store(request $request)
    {
        dd($request->all());
        $this->validate($request, [
            'company_id' => 'required',
            'customer_id' => 'required'
        ]);
        if ($request->gst_flag == 0) {
            $invoice = new Invoice();
            $invoice->fill($request->all());
            $invoice->base_amount = $request->total_amount + $request->discount;
            $invoice->save();
            // if ($request->product_counter > 0) {
            for ($i = 0; $i < $request->row_count; $i++) {
                // $counter = $counter + 1;
                $product_description = 'product_description_' . $i;
                $product_amount = 'product_amount_' . $i;
                $productInvoice = new ProductInvoice();
                $productInvoice->invoice_id = $invoice->invoice_id;
                $productInvoice->product_description = $request->$product_description;
                $productInvoice->product_amount = $request->$product_amount;
                $productInvoice->save();
            }
            // }
        } else {
            // dd($request->all());
            $invoice = new Invoice();
            $invoice->fill($request->all());
            $invoice->base_amount = $request->total_amount_all;
            $invoice->total_cgst_percent = $request->total_cgst_all;
            $invoice->total_sgst_percent = $request->total_sgst_all;
            $invoice->total_igst_percent = $request->total_igst_all;
            $invoice->total_amount = $request->total_amount_all_gst;
            $invoice->gst_flag = $request->gst_flag;
            $invoice->save();
            // if ($request->product_counter > 0) {
            for ($i = 0; $i < $request->row_count; $i++) {
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
                $productInvoice = new ProductInvoice();
                $productInvoice->invoice_id = $invoice->invoice_id;
                $productInvoice->product_id = $request->$product_id;
                $productInvoice->hsn_code = $request->$hsn_code;
                $productInvoice->quantity = $request->$quantity;
                $productInvoice->p_unit = $request->$p_unit;
                $productInvoice->rate = $request->$rate;
                $productInvoice->product_amount = $request->$amount;
                $productInvoice->cgst_percent = $request->$cgst_percent;
                $productInvoice->cgst_amount = $request->$cgst_amount;
                $productInvoice->sgst_percent = $request->$sgst_percent;
                $productInvoice->sgst_amount = $request->$sgst_amount;
                $productInvoice->igst_percent = $request->$igst_percent;
                $productInvoice->igst_amount = $request->$igst_amount;
                $productInvoice->discount = $request->$discount;
                $productInvoice->product_total_amount = $request->$product_total_amount;

                // Updating the product stock
                $product = Product::where('product_id', $request->$product_id)->first();
                if ($product) {
                    // dd($product);
                    $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                    $product->save();
                }

                $productInvoice->save();
            }
            // }
        }
        return redirect()->route('admin.invoice.index')->with('success', 'Invoice added Successfully');
    }

    public function edit($id)
    {
        $units = Unit::get();
        $companies = Company::pluck('company_name', 'company_id');
        $customers = Customers::pluck('customer_name', 'customer_id');
        $invoice = Invoice::with('productsInvoice')->where('invoice_id', $id)->first();
        // dd($invoice);
        $vehicle_make = Vehicle::with('make')->where('customer_id', $invoice->customer_id)->get()->pluck('make.vehicle_make_name', 'vehicle_make_id');
        $total_quantity = 0;
        foreach ($invoice->productsInvoice as $product) {
            // dd($product->invoice_id);
            $total_quantity = $total_quantity + $product->quantity;
        }

        $products = Product::where('company_id', $invoice->company_id)->get();
        // dd($products);
        // dd($invoice);
        // $editdata = Invoice::where('customer_id', $id)->first();

        return view('backend.invoice.edit', compact('invoice', 'companies', 'customers', 'vehicle_make', 'products', 'units', 'total_quantity'));
    }

    public function update(request $request)
    {
        // dd(getType(json_decode($request->editData)));
        $edit_counter =  json_decode($request->editData);
        // dump($edit_counter);
        // dd($request->all());
        $this->validate($request, [
            'company_id' => 'required',
            'customer_id' => 'required'
        ]);
        if ($request->gst_flag == 0) {
            $invoice = Invoice::where('invoice_id', $request->invoice_id)->first();
            $invoice->fill($request->all());
            $invoice->base_amount = $request->total_amount + $request->discount;
            $invoice->save();

            // if ($request->product_counter > 0) {
            ProductInvoice::where('invoice_id', $request->invoice_id)->delete();
            for ($i = 0; $i < $request->row_count; $i++) {
                // dump($edit_counter->{$i});
                $product_description = 'product_description_' . $edit_counter->{$i};
                $product_amount = 'product_amount_' . $edit_counter->{$i};
                // $product_invoice_id = 'product_invoice_id_' . $edit_counter->{$i};
                // $productInvoice = ProductInvoice::updateOrCreate(
                //     [
                //         'product_invoice_id' => $request->$product_invoice_id,
                //     ],
                //     [
                //         'invoice_id' => $invoice->invoice_id,
                //         'product_description' => $request->$product_description,
                //         'product_amount' => $request->$product_amount
                //     ]
                // );
                $productInvoice = new ProductInvoice();
                $productInvoice->invoice_id = $invoice->invoice_id;
                $productInvoice->product_description = $request->$product_description;
                $productInvoice->product_amount = $request->$product_amount;
                $productInvoice->save();
            }
            // dd();
            // }
        } else {
            // dd($request->all());
            $invoice = Invoice::where('invoice_id', $request->invoice_id)->first();
            $invoice->fill($request->all());
            $invoice->base_amount = $request->total_amount_all;
            $invoice->total_cgst_percent = $request->total_cgst_all;
            $invoice->total_sgst_percent = $request->total_sgst_all;
            $invoice->total_igst_percent = $request->total_igst_all;
            $invoice->total_amount = $request->total_amount_all_gst;
            $invoice->gst_flag = $request->gst_flag;
            $invoice->save();
            // if ($request->product_counter > 0) {
            ProductInvoice::where('invoice_id', $request->invoice_id)->delete();
            for ($i = 0; $i < $request->row_count; $i++) {
                // $counter = $counter + 1;
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
                $previous_quantity = 'previous_quantity_' . $edit_counter->{$i};
                $productInvoice = new ProductInvoice();

                if (isset($request->$previous_quantity)) {
                    $product = Product::where('product_id', $request->$product_id)->first();
                    if ($product) {
                        // dd((int)$productInvoice->quantity);
                        $product->product_stock = (int)$product->product_stock + (int)$request->$previous_quantity;
                        // dd((int)$productInvoice->quantity);
                        // dd((int)$productInvoice->quantity);
                        $product->save();
                    }
                    // dd($product);
                }
                $product = Product::where('product_id', $request->$product_id)->first();
                if ($product) {
                    $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                    $product->save();
                }


                $productInvoice->invoice_id = $invoice->invoice_id;
                $productInvoice->product_id = $request->$product_id;
                $productInvoice->hsn_code = $request->$hsn_code;
                $productInvoice->quantity = $request->$quantity;
                $productInvoice->p_unit = $request->$p_unit;
                $productInvoice->rate = $request->$rate;
                $productInvoice->product_amount = $request->$amount;
                $productInvoice->cgst_percent = $request->$cgst_percent;
                $productInvoice->cgst_amount = $request->$cgst_amount;
                $productInvoice->sgst_percent = $request->$sgst_percent;
                $productInvoice->sgst_amount = $request->$sgst_amount;
                $productInvoice->igst_percent = $request->$igst_percent;
                $productInvoice->igst_amount = $request->$igst_amount;
                $productInvoice->discount = $request->$discount;
                $productInvoice->product_total_amount = $request->$product_total_amount;
                // dd($productInvoice->quantity);
                // Updating the product stock



                $productInvoice->save();
            }
            // }
        }
        echo 'success';
        // return redirect()->route('admin.invoice.index')->with('success', 'Invoice added Successfully');
    }
    public function delete($id)
    {
        $deletedata = Invoice::findOrFail($id);
        if ($deletedata->delete()) {
            return redirect()->route('admin.invoice.index')->with('success', 'Invoice Deleted Successfully');
        } else {
            return redirect()->route('admin.invoice.index')->with('error', 'Failed to Delte the Invoice');
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
    // public function getInvoices(Request $request)
    // {
    //     Invoice::where('company_id', $request->company_id)->orderBy('invoice_id', 'DESC')->get();
    // }

}
