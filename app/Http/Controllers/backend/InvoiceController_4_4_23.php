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
use GrahamCampbell\ResultType\Success;

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
        // dd($request->all());
        $this->validate($request, [
            'company_id' => 'required',
            'customer_id' => 'required'
        ]);
        if ($request->gst_flag == 0) {
            $invoice = new Invoice();
            // $invoice->invoice_no = $last_invoice_id;
            $invoice->fill($request->all());
            if (!($request->invoice_cum_challan)) {
                $invoice->invoice_cum_challan = 0;
            }
            $last_invoice = Invoice::orderBy('invoice_id', 'DESC')->get('invoice_id')->toArray();
            $last_invoice_id = '0001';
            if ($last_invoice) {
                $last_invoice_id = $last_invoice[0]['invoice_id'] + 1;
                $last_invoice_id = '000' . $last_invoice_id;
                // dd('hello');
            }
            $invoice->invoice_no = $last_invoice_id;
            // $invoice->base_amount = $request->total_amount + $request->discount;
            $invoice->base_amount = $request->cwg_total_amount_all_without_gst;
            $invoice->total_amount = $request->total_amount_all_gst;


            $invoice->save();

            // if ($request->product_counter > 0) {
            // for ($i = 0; $i < $request->row_count; $i++) {
            foreach ($request->product_row_counter as $product_row_count) {
                $i = $product_row_count;

                // $counter = $counter + 1;
                $product_id = 'product_description_' . $i;
                $hsn_code = 'hsn_code_' . $i;
                $quantity = 'quantity_' . $i;
                $orignal_amt = 'orignal_amt_' . $i;
                $orignal_hidden_rate = 'cwg_rate_' . $i;
                $amount = 'amount_' . $i;
                $p_unit = 'p_unit_' . $i;
                $rate = 'rate_' . $i;
                $discount = 'discount_' . $i;
                $product_total_amount = 'total_amount_' . $i;

                // $product_amount = 'product_amount_' . $i;
                $productInvoice = new ProductInvoice();
                $productInvoice->invoice_id = $invoice->invoice_id;
                $productInvoice->product_id = $request->$product_id;

                $productInvoice->hsn_code = $request->$hsn_code;
                $productInvoice->quantity = $request->$quantity;

                $productInvoice->orignal_amt = $request->$orignal_amt;
                $productInvoice->orignal_hidden_rate = $request->$orignal_hidden_rate;

                $productInvoice->p_unit = $request->$p_unit;
                $productInvoice->rate = $request->$rate;
                $productInvoice->product_amount = $request->$amount;
                $productInvoice->discount = $request->$discount;
                $productInvoice->product_total_amount = $request->$product_total_amount;


                $product = Product::where('product_id', $request->$product_id)->first();
                if ($request->$p_unit == '1') {
                    $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                } else if ($request->$p_unit == '2') {
                    $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                } else if ($request->$p_unit == '3') {
                    $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                } else if ($request->$p_unit == '4') {
                    $product->product_stock = (int)$product->product_stock - $request->$quantity * 1000;
                } else if ($request->$p_unit == '5') {
                    $product->product_stock = (int)$product->product_stock - (float)$request->$quantity * 1000;
                }
                $product->save();



                $productInvoice->save();
            }
            // }
        } else {
            // dd($request->all());
            $invoice = new Invoice();
            $invoice->fill($request->all());
            if (!($request->invoice_cum_challan)) {
                $invoice->invoice_cum_challan = 0;
            }
            $invoice->base_amount = $request->total_amount_all;
            $invoice->total_cgst_percent = $request->total_cgst_all;
            $invoice->total_sgst_percent = $request->total_sgst_all;
            $invoice->total_igst_percent = $request->total_igst_all;
            $invoice->total_amount = $request->total_amount_all_gst;
            $invoice->gst_flag = $request->gst_flag;
            $last_invoice = Invoice::orderBy('invoice_id', 'DESC')->get('invoice_id')->toArray();
            $last_invoice_id = '0001';
            if ($last_invoice) {
                $last_invoice_id = $last_invoice[0]['invoice_id'] + 1;
                $last_invoice_id = '000' . $last_invoice_id;
                // dd('hello');
            }
            $invoice->invoice_no = $last_invoice_id;
            if ($request->product_counter > 0) {
                $invoice->save();

                // for ($i = 0; $i < $request->row_count; $i++) {
                if (isset($request->product_row_counter)) {

                    foreach ($request->product_row_counter as $product_row_count) {
                        $i = $product_row_count;

                        // $counter = $counter + 1;
                        $product_id = 'product_description_' . $i;
                        $hsn_code = 'hsn_code_' . $i;
                        $quantity = 'quantity_' . $i;

                        $orignal_amt = 'orignal_amt_' . $i;
                        $orignal_hidden_rate = 'cwg_rate_' . $i;

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

                        $productInvoice->orignal_amt = $request->$orignal_amt;
                        $productInvoice->orignal_hidden_rate = $request->$orignal_hidden_rate;

                        $productInvoice->cgst_percent = $request->$cgst_percent;
                        $productInvoice->cgst_amount = $request->$cgst_amount;
                        $productInvoice->sgst_percent = $request->$sgst_percent;
                        $productInvoice->sgst_amount = $request->$sgst_amount;
                        $productInvoice->igst_percent = $request->$igst_percent;
                        $productInvoice->igst_amount = $request->$igst_amount;
                        $productInvoice->discount = $request->$discount;
                        $productInvoice->product_total_amount = $request->$product_total_amount;

                        // $data = [
                        //     'invoice_id' => $invoice->invoice_id,
                        //     'product_id' => $request->$product_id,
                        //     'hsn_code' => $request->$hsn_code,
                        //     'quantity' => $request->quantity,
                        //     'p_unit' => $request->$p_unit,
                        //     'rate' => $request->$rate,
                        //     'product_amount' => $request->$amount,
                        //     'cgst_percent' => $request->$cgst_percent,
                        //     'cgst_amount' => $request->$cgst_amount,
                        //     'sgst_percent' => $request->$sgst_percent,
                        //     'sgst_amount' => $request->$sgst_amount,
                        //     'igst_percent' => $request->$igst_percent,
                        //     'igst_amount' => $request->$igst_amount,
                        //     'discount' => $request->$discount,
                        //     'product_total_amount' => $request->$product_total_amount
                        // ];


                        // if ($request->$p_unit != '2' || $request->$p_unit != '3') {
                        // Updating the product stock
                        // $product = Product::where('product_id', $request->$product_id)->first();
                        // if ($product) {
                        // dd($product->product_unit);
                        // $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                        // $product->save();
                        // }
                        // }


                        // by ip
                        $product = Product::where('product_id', $request->$product_id)->first();
                        if ($request->$p_unit == '1') {
                            $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                        } else if ($request->$p_unit == '2') {
                            $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                        } else if ($request->$p_unit == '3') {
                            $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                        } else if ($request->$p_unit == '4') {
                            $product->product_stock = (int)$product->product_stock - $request->$quantity * 1000;
                        } else if ($request->$p_unit == '5') {
                            $product->product_stock = (int)$product->product_stock - (float)$request->$quantity * 1000;
                        }
                        $product->save();






                        // $productInvoice->fill($data);
                        $productInvoice->save();
                    }
                }


                return redirect()->route('admin.invoice.index')->with('success', 'Invoice added Successfully');
            } else {
                return redirect()->route('admin.invoice.create')->with('error', 'Please Add Row First');
            }
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
            $total_quantity = $total_quantity + $product->quantity;
        }

        $products = Product::whereIn('company_id', [$invoice->company_id, 1])->get();
        return view('backend.invoice.edit', compact('invoice', 'companies', 'customers', 'vehicle_make', 'products', 'units', 'total_quantity'));
    }

    public function update(request $request)
    {

        // dd($request->all());

        $edit_counter =  json_decode($request->editData);
        // dd($edit_counter);

        $this->validate($request, [
            'company_id' => 'required',
            'customer_id' => 'required'
        ]);
        if ($request->gst_flag == 0) {
            $invoice = Invoice::where('invoice_id', $request->invoice_id)->first();

            $invoice->fill($request->all());
            if (!($request->invoice_cum_challan)) {
                $invoice->invoice_cum_challan = 0;
            }
            // $invoice->base_amount = $request->total_amount + $request->discount;
            $invoice->base_amount = $request->cwg_total_amount_all_without_gst;
            $invoice->total_amount = $request->total_amount_all_gst;
            $invoice->save();

            // if ($request->product_counter > 0) {





            $product_ids_to_delete = [];
            $product_invoices = ProductInvoice::where('invoice_id', $request->invoice_id)->get();
            foreach ($edit_counter as $product_row_count) {
                $product_id_string = "product_description_{$product_row_count}";
                $product_ids_to_delete[] = $request->$product_id_string;
            }
            foreach ($product_invoices as $product_invoice) {

                // $str = "product_description_0";
                // $pattern = "/product_description_/i";
                // if(preg_match($pattern, $str))
                if (in_array($product_invoice->product_id, $product_ids_to_delete)) {
                    continue;
                }
                $product = Product::where('product_id', $product_invoice->product_id)->first();
                $stock = 0;

                if ($product_invoice->p_unit == '1') {

                    $stock = (int)$product->product_stock + (int)$product_invoice->quantity;
                    $product->product_stock = $stock;
                } elseif ($product_invoice->p_unit == '2') {

                    $stock = (int)$product->product_stock + (int)$product_invoice->quantity;
                    $product->product_stock = $stock;
                } elseif ($product_invoice->p_unit == '3') {

                    $stock = (int)$product->product_stock + (int)$product_invoice->quantity;
                    $product->product_stock = $stock;
                } elseif ($product_invoice->p_unit == '4') {

                    $stock = (int)$product->product_stock + (float)$product_invoice->quantity * 1000;
                    $product->product_stock = $stock;
                } elseif ($product_invoice->p_unit == '5') {
                    $stock = (int)$product->product_stock + (float)$product_invoice->quantity * 1000;
                    $product->product_stock = $stock;
                }
                $product->save();
            }







            ProductInvoice::where('invoice_id', $request->invoice_id)->delete();
            for ($i = 0; $i < $request->row_count; $i++) {

                $product_id = 'product_description_' . $edit_counter->{$i};
                // $product_amount = 'product_amount_' . $edit_counter->{$i};
                $hsn_code = 'hsn_code_' .  $edit_counter->{$i};
                $quantity = 'quantity_' .  $edit_counter->{$i};

                $orignal_amt = 'orignal_amt_' . $edit_counter->{$i};
                $orignal_hidden_rate = 'cwg_rate_' . $edit_counter->{$i};

                $amount = 'amount_' .  $edit_counter->{$i};
                $p_unit = 'p_unit_' .  $edit_counter->{$i};
                $rate = 'rate_' .  $edit_counter->{$i};
                $discount = 'discount_' .  $edit_counter->{$i};
                $product_total_amount = 'total_amount_' .  $edit_counter->{$i};
                $previous_quantity = 'previous_quantity_' . $edit_counter->{$i};


                $productInvoice = new ProductInvoice();
                $productInvoice->invoice_id = $invoice->invoice_id;
                $productInvoice->product_id = $request->$product_id;
                // $productInvoice->product_amount = $request->$product_amount;

                $productInvoice->hsn_code = $request->$hsn_code;
                $productInvoice->quantity = $request->$quantity;
                $productInvoice->p_unit = $request->$p_unit;
                $productInvoice->rate = $request->$rate;

                $productInvoice->orignal_amt = $request->$orignal_amt;
                $productInvoice->orignal_hidden_rate = $request->$orignal_hidden_rate;

                $productInvoice->product_amount = $request->$amount;
                $productInvoice->discount = $request->$discount;
                $productInvoice->product_total_amount = $request->$product_total_amount;

                if (isset($request->$previous_quantity)) {
                    $product = Product::where('product_id', $request->$product_id)->first();
                    if ($request->$p_unit == '1') {
                        $product->product_stock = (int)$product->product_stock + (int)$request->$previous_quantity;
                    } else if ($request->$p_unit == '2') {
                        $product->product_stock = (int)$product->product_stock + (int)$request->$previous_quantity;
                    } else if ($request->$p_unit == '3') {
                        $product->product_stock = (int)$product->product_stock + (int)$request->$previous_quantity;
                    } else if ($request->$p_unit == '4') {
                        // dd((int)$product->product_stock);
                        $product->product_stock = (int)$product->product_stock + (float)$request->$previous_quantity * 1000;
                    } else if ($request->$p_unit == '5') {
                        $product->product_stock = (int)$product->product_stock + (float)$request->$previous_quantity * 1000;
                    }
                    $product->save();
                }


                $product = Product::where('product_id', $request->$product_id)->first();
                if ($request->$p_unit == '1') {
                    $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                } else if ($request->$p_unit == '2') {
                    $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                } else if ($request->$p_unit == '3') {
                    $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                } else if ($request->$p_unit == '4') {
                    $product->product_stock = (int)$product->product_stock - (float)$request->$quantity * 1000;
                } else if ($request->$p_unit == '5') {
                    $product->product_stock = (int)$product->product_stock - (float)$request->$quantity * 1000;
                }
                $product->save();

                $productInvoice->save();
            }
            // }
        } else {

            $invoice = Invoice::where('invoice_id', $request->invoice_id)->first();
            $invoice->fill($request->all());
            if (!($request->invoice_cum_challan)) {
                $invoice->invoice_cum_challan = 0;
            }
            $invoice->base_amount = $request->total_amount_all;
            $invoice->total_cgst_percent = $request->total_cgst_all;
            $invoice->total_sgst_percent = $request->total_sgst_all;
            $invoice->total_igst_percent = $request->total_igst_all;
            $invoice->total_amount = $request->total_amount_all_gst;
            $invoice->gst_flag = $request->gst_flag;

            if ($request->row_count > 0) {
                $invoice->save();



                //for minus after delete row
                $product_ids_to_delete = [];
                $product_invoices = ProductInvoice::where('invoice_id', $request->invoice_id)->get();
                foreach ($edit_counter as $product_row_count) {
                    $product_id_string = "product_description_{$product_row_count}";
                    $product_ids_to_delete[] = $request->$product_id_string;
                }
                foreach ($product_invoices as $product_invoice) {

                    // $str = "product_description_0";
                    // $pattern = "/product_description_/i";
                    // if(preg_match($pattern, $str))
                    if (in_array($product_invoice->product_id, $product_ids_to_delete)) {
                        continue;
                    }



                    $product = Product::where('product_id', $product_invoice->product_id)->first();
                    $stock = 0;

                    if ($product_invoice->p_unit == '1') {

                        $stock = (int)$product->product_stock + (int)$product_invoice->quantity;
                        $product->product_stock = $stock;
                    } elseif ($product_invoice->p_unit == '2') {

                        $stock = (int)$product->product_stock + (int)$product_invoice->quantity;
                        $product->product_stock = $stock;
                    } elseif ($product_invoice->p_unit == '3') {

                        $stock = (int)$product->product_stock + (int)$product_invoice->quantity;
                        $product->product_stock = $stock;
                    } elseif ($product_invoice->p_unit == '4') {

                        $stock = (int)$product->product_stock + (float)$product_invoice->quantity * 1000;
                        $product->product_stock = $stock;
                    } elseif ($product_invoice->p_unit == '5') {
                        $stock = (int)$product->product_stock + (float)$product_invoice->quantity * 1000;
                        $product->product_stock = $stock;
                    }
                    $product->save();
                }


                ProductInvoice::where('invoice_id', $request->invoice_id)->delete();



                for ($i = 0; $i < $request->row_count; $i++) {
                    $product_id = 'product_description_' . $edit_counter->{$i};
                    $hsn_code = 'hsn_code_' . $edit_counter->{$i};
                    $quantity = 'quantity_' . $edit_counter->{$i};
                    $amount = 'amount_' . $edit_counter->{$i};
                    $p_unit = 'p_unit_' . $edit_counter->{$i};
                    $rate = 'rate_' . $edit_counter->{$i};

                    $orignal_amt = 'orignal_amt_' . $edit_counter->{$i};
                    $orignal_hidden_rate = 'cwg_rate_' . $edit_counter->{$i};

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

                    //by ip
                    if (isset($request->$previous_quantity)) {
                        $product = Product::where('product_id', $request->$product_id)->first();
                        if ($request->$p_unit == '1') {
                            $product->product_stock = (int)$product->product_stock + (int)$request->$previous_quantity;
                        } else if ($request->$p_unit == '2') {
                            
                            $product->product_stock = (int)$product->product_stock + (int)$request->$previous_quantity;
                            dd($product->product_stock);

                        } else if ($request->$p_unit == '3') {
                            $product->product_stock = (int)$product->product_stock + (int)$request->$previous_quantity;
                        } else if ($request->$p_unit == '4') {

                            if (strpos($request->$previous_quantity, ".") !== false) {
                                $product->product_stock = (int)$product->product_stock + (float)$request->$previous_quantity * 1000;
                            } else {

                                $product->product_stock = (int)$product->product_stock + (float)$request->$previous_quantity;
                            }

                        } else if ($request->$p_unit == '5') {
                            $product->product_stock = (int)$product->product_stock + (float)$request->$previous_quantity * 1000;
                        }
                        $product->save();
                    }

                    // by ip
                    $product = Product::where('product_id', $request->$product_id)->first();
                    if ($request->$p_unit == '1') {
                        $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                    } else if ($request->$p_unit == '2') {
                        $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                    } else if ($request->$p_unit == '3') {
                        $product->product_stock = (int)$product->product_stock - (int)$request->$quantity;
                    } else if ($request->$p_unit == '4') {
                        $product->product_stock = (int)$product->product_stock - (float)$request->$quantity * 1000;
                    } else if ($request->$p_unit == '5') {
                        $product->product_stock = (int)$product->product_stock - (float)$request->$quantity * 1000;
                    }
                    $product->save();


                    $productInvoice->invoice_id = $invoice->invoice_id;
                    $productInvoice->product_id = $request->$product_id;
                    $productInvoice->hsn_code = $request->$hsn_code;
                    $productInvoice->quantity = $request->$quantity;
                    $productInvoice->p_unit = $request->$p_unit;
                    $productInvoice->rate = $request->$rate;

                    $productInvoice->orignal_amt = $request->$orignal_amt;
                    $productInvoice->orignal_hidden_rate = $request->$orignal_hidden_rate;

                    $productInvoice->product_amount = $request->$amount;
                    $productInvoice->cgst_percent = $request->$cgst_percent;
                    $productInvoice->cgst_amount = $request->$cgst_amount;
                    $productInvoice->sgst_percent = $request->$sgst_percent;
                    $productInvoice->sgst_amount = $request->$sgst_amount;
                    $productInvoice->igst_percent = $request->$igst_percent;
                    $productInvoice->igst_amount = $request->$igst_amount;
                    $productInvoice->discount = $request->$discount;
                    $productInvoice->product_total_amount = $request->$product_total_amount;
                    $productInvoice->save();
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

        $invoice = Invoice::with('productsInvoice')->where('invoice_id', $id)->first();

        $company_short_name = Company::where('company_id', $invoice->company_id)->first();
        // dd($company_short_name->toArray());
        return view('backend.invoice.view', compact('invoice', 'company_short_name'));
    }
    public function delete($id)
    {
        // $deletedata = Invoice::with('productsInvoice')->where('invoice_id', $id)->first();
        // if ($deletedata) {
        //     foreach ($deletedata->productsInvoice as $data) {
        //         $product = Product::where('product_id', $data->product_id)->first();
        //         if ($product) {
        //             if ($product->p_unit != '4' || $product->p_unit != '5') {
        //             if (isset($data->quantity)) {
        //                 $product->product_stock = $product->product_stock + $data->quantity;
        //                 $product->save();
        //             }
        //             } 
        //         }
        //     }
        // }



        //by ip
        $deletedata = Invoice::where('invoice_id', $id)->first();

        if ($deletedata) {
            $productInvoice = ProductInvoice::where('invoice_id', $id)->get();

            foreach ($productInvoice as $data) {
                $product = Product::where('product_id', $data->product_id)->first();
                // dd($product->product_stock);
                if ($product) {
                    // foreach ($product as $products) {
                    if ($data->p_unit == '1') {
                        $product->product_stock = (int)$product->product_stock + (int)$data->quantity;
                    } else if ($data->p_unit == '2') {
                        $product->product_stock = (int)$product->product_stock + (int)$data->quantity;
                    } else if ($data->p_unit == '3') {
                        $product->product_stock = (int)$product->product_stock + (int)$data->quantity;
                    } else if ($data->p_unit == '4') {
                        $product->product_stock = (int)$product->product_stock + (int)$data->quantity * 1000;
                        // dd($product->product_stock);
                    } else if ($data->p_unit == '2') {
                        $product->product_stock = (int)$product->product_stock + (int)$data->quantity * 1000;
                    }
                    // } 
                    // dd($product->toArray());
                    $product->save();
                }
            }


            for ($i = 0; $i < count($productInvoice); $i++) {
                // dd($productInvoice[$i]->toArray());
                $productInvoice[$i]->delete();
            }
            $deletedata->delete();
        }



        // if ($deletedata->delete()) {
        //     ProductInvoice::where('invoice_id', $id)->delete();
        return redirect()->route('admin.invoice.index')->with('success', 'Invoice Deleted Successfully');
        // } else {
        // return redirect()->route('admin.invoice.index')->with('error', 'Failed to Delte the Invoice');
        // }
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
        $products = Product::whereIn('company_id', [$request->company_id, 1])->get();

        // dd($products->toArray());
        echo json_encode($products);
    }
    public function getProduct(Request $request)
    {
        // $request->all();
        $product = Product::where('product_id', $request->product_id)->get();
        // $unit = Unit::where('unit', $product->product_unit)->first();
        // $product_and_unit = array(
        //     'product' => "$product",
        //     'unit' => "$unit"
        // );
        // $product_and_unit = array(
        //     $product->toArray(),$unit->toArray()
        // );
        // dd($product_and_unit);

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


    //byip
    public function qty(Request $request)
    {

        dd($request->all());
        // $product = Product::where('product_id', $request->product_id)->first();
        // $stock = 0;
        // if ($product->product_stock) {
        //     $stock = $product->product_stock + $request->quantity_value;
        //     $product->product_stock = $stock;
        //     $product->save();
        // }

        // if ($product->product_stock) {
        //     if ($request->unit == '1') {
        //         $product->product_stock = $product->product_stock + $request->quantity_value;
        //     } else if ($request->unit == '2') {
        //         $product->product_stock = $product->product_stock + $request->quantity_value;
        //     } else if ($request->unit == '3') {
        //         $product->product_stock = $product->product_stock + $request->quantity_value;
        //     } else if ($request->unit == '4') {
        //         $product->product_stock = $product->product_stock + $request->quantity_value * 1000;
        //     } else if ($request->unit == '5') {
        //         $product->product_stock = $product->product_stock + $request->quantity_value * 1000;
        //     }
        //     $product->save();
        // }

        // return;
    }

    //by ip
    public function defultunit(Request $request)
    {

        echo "hello";
    }
}
