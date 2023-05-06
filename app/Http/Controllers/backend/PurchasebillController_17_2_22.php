<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\Finalpurchasebill;
use App\Models\backend\Financialyear;
use App\Models\backend\Product;
use App\Models\backend\Purchasebill;
use App\Models\backend\Supplier;
use App\Models\backend\Tax;
use App\Models\backend\Unit;
use App\Models\backend\Paymentmode;
use App\Models\backend\Productgroup;
use App\Models\backend\Unit as BackendUnit;
use Illuminate\Http\Request;
use Session;

// use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class PurchasebillController extends Controller
{
    public function index()
    {

        // $purchase_bill_details = Purchasebill::with('company', 'supplier')->get();
        $purchase_bill_details = Finalpurchasebill::with('company', 'supplier', 'Product_details')->get();
        // dd($purchase_bill_details->toArray());



        return view('backend.purchasebill.index', compact('purchase_bill_details'));
    }
    public function create()
    {
        // $all_product = count(Finalpurchasebill::all());
        $all_product = Finalpurchasebill::max('invoice_no');
        // dd($all_product);

        $financial_year = Financialyear::Where('default_flag', 1)->first(['financial_year']);
        // dd($financial_year->toArray());

        $data = Supplier::all();
        $supplier = Supplier::pluck('s_name', 'supplier_id');
        $products = Product::pluck('product_name', 'product_id');
        $p_unit = Unit::pluck('unit', 'unit');
        $comapany = Company::pluck('company_name', 'company_id');
        $gst_percent = Tax::pluck('gst_value', 'gst_value');
        $payment_mode = Paymentmode::pluck('payment_mode', 'payment_mode');
        $product_grp = Productgroup::pluck('group_name', 'group_id');

        // dd($payment_mode);

        return view('backend.purchasebill.create', compact('supplier', 'comapany', 'gst_percent', 'products', 'data', 'payment_mode', 'p_unit', 'all_product', 'financial_year','product_grp'));
    }

    public function store(request $request)
    {
        dd($request->all());

        $this->validate($request, [
            'supplier_id'   => 'required',
            'company_id' => 'required',
            'supplier_bill_no' => 'required',
            'dated' => 'required',
            'payment_mode' => 'required'
        ]);


        $last_invoice_id = Finalpurchasebill::orderBy('id', 'DESC')->first(['id']);
        if ($last_invoice_id) {
            // dd($last_invoice_id);
            $last_invoice_id = $last_invoice_id['id'] + 1;
            // dd($last_invoice_id);
        } else {
            $last_invoice_id = 1;
        }




        $final_purchase_bill = new Finalpurchasebill();

        $data = [
            'supplier_id' => $request->supplier_id,
            'company_id' => $request->company_id,
            'supplier_bill_no' => $request->supplier_bill_no,
            'invoice_no' => $request->purchase_bill_no,
            'dated' => $request->dated,
            'payment_mode' => $request->payment_mode,
            'cheque_no' => $request->cheque_no,
            'bank_name' => $request->bank_name,
            'cheque_date' => $request->cheque_date,
            'electronic_payment_ref' => $request->electronic_payment_ref,
            'amount_words' => $request->amount_words,
            'flag' => 'Y',
            'gst_flag' => '1',
            'type' => 'p',
            'financial_year' => $request->financial_year
        ];

        $final_purchase_bill->fill($data);
        $final_purchase_bill->invoice_no = $last_invoice_id;
        // $final_purchase_bill->gst_flag = 1;
        // $final_purchase_bill->electronic_transaction_ref = $request->electronic_payment_ref;

        if (isset($request->product_name)) {
            if ($final_purchase_bill->save()) {



                for ($i = 0; $i < count($request->product_name); $i++) {

                    $purchase_bill = new Purchasebill();

                    if ($request->supplier_state == '21') {
                        $purchase_bill_igst = "0";
                        $purchase_bill_sgst = $request->gst_amount[$i] / 2;
                        $purchase_bill_cgst = $request->gst_amount[$i] / 2;

                        $purchase_bill_igst_percent = "0";
                        $purchase_bill_sgst_percent = $request->cgst_percent[$i] / 2;
                        $purchase_bill_cgst_percent = $request->cgst_percent[$i] / 2;

                        $purchase_bill_igst_total = '0';
                        $purchase_bill_sgst_total = $request->final_igst_amount / 2;
                        $purchase_bill_cgst_total = $request->final_igst_amount / 2;
                    } else {
                        $purchase_bill_igst = $request->gst_amount[$i];
                        $purchase_bill_sgst = '0';
                        $purchase_bill_cgst = '0';

                        $purchase_bill_igst_percent = $request->cgst_percent[$i];
                        $purchase_bill_sgst_percent = '0';
                        $purchase_bill_cgst_percent = '0';

                        $purchase_bill_igst_total = $request->final_igst_amount;
                        $purchase_bill_sgst_total = '0';
                        $purchase_bill_cgst_total = '0';
                    }

                    $product_data = [
                        'financial_year' => $request->financial_year,
                        'invoice_no' => $last_invoice_id,
                        'supplier_id' => $request->supplier_id,
                        'company_id' => $request->company_id,
                        'product_name' => $request->product_name[$i],
                        'hsn_code' => $request->hsn_code[$i],
                        // 'p_part_no' => $request->p_part_no[$i],
                        // 'p_custom_port_no' => $request->p_custom_port_no[$i],
                        'quantity' => $request->quantity[$i],
                        'rate' => $request->rate[$i],
                        'amount' => $request->amount[$i],
                        'product_unit' => $request->unit[$i],
                        // 'cgst_percent' => $request->cgst_percent[$i],
                        // 'cgst' => $request->gst_amount[$i],
                        'discount' => $request->discount[$i],
                        'row_total_gst' => $request->total_amount[$i],
                        'total_quantity' => $request->finalquantity,
                        'total_init_amount' => $request->finalamount,
                        'total_amount' => $request->finalgstamount,
                        'type' => 'p',

                        'igst' => $purchase_bill_igst,
                        'sgst' => $purchase_bill_sgst,
                        'cgst' => $purchase_bill_cgst,
                        'igst_percent' => $purchase_bill_igst_percent,
                        'sgst_percent' => $purchase_bill_sgst_percent,
                        'cgst_percent' => $purchase_bill_cgst_percent,
                        'igst_total' => $purchase_bill_igst_total,
                        'sgst_total' => $purchase_bill_sgst_total,
                        'cgst_total' => $purchase_bill_cgst_total

                    ];

                    // dd($product_data);
                    $purchase_bill->fill($product_data);
                    // dd($product_data);
                    $purchase_bill->save();
                }


                // dd($request->product_name);
                $r_grams = 0;
                for ($i = 0; $i < count($request->product_name); $i++) {

                    $pro_q = Product::where('product_name', $request->product_name[$i])->first();
                    dd($request->grams);


                    $r_grams = $r_grams+(int)$request->grams[$i];
                    dd($r_grams);

                    if (isset($pro_q->grams)) {
                        $grams = (int)$pro_q->grams+ $r_grams; //;(int)$request->grams;
                        // dd($grams);
                    $pro_q->grams =  $grams;
                    $pro_q->save();

                    }



                    if (isset($pro_q->product_stock)) {

                        $product_quantity = (int)$pro_q->product_stock + (int)$request->quantity[$i];
                        $pro_q->product_stock = $product_quantity;
                        $pro_q->save();
                    } else {

                        $m_product = new Product();
                        $product_arr = [

                            'company_id' => $request->company_id,
                            'product_name' => $request->product_name[$i],
                            'hsn_code' => $request->hsn_code[$i],
                            'product_stock' => $request->quantity[$i],
                            'product_rate' => $request->rate[$i],
                            'product_unit' => $request->unit[$i],
                            'gst_percent' => $request->cgst_percent[$i],

                        ];

                        $m_product->fill($product_arr);
                        $m_product->save();
                    }
                }
            }
        }

        // dd('ok');
        // Session::flash('error', 'This is a message!'); 
        return redirect('admin/purchase/bill/')->with('success', 'Purchase Bill Created Successfully');
    }

    public function edit($id)
    {
        $all_product = count(Finalpurchasebill::all());


        $data = Supplier::all();
        $supplier = Supplier::pluck('s_name', 'supplier_id');
        $products = Product::pluck('product_name', 'product_id');

        // dd($products);
        $p_unit = Unit::pluck('unit', 'unit');
        $comapany = Company::pluck('company_name', 'company_id');
        $gst_percent = Tax::pluck('gst_value', 'gst_value');
        $payment_mode = Paymentmode::pluck('payment_mode', 'payment_mode');

        $editdata = Finalpurchasebill::where('invoice_no', $id)->with('Product_details')->get();
        // dd($editdata);
        foreach ($editdata as $data) {
        }
        return view('backend.purchasebill.edit', compact('data', 'supplier', 'comapany', 'gst_percent', 'products', 'data', 'payment_mode', 'p_unit', 'all_product'));
    }

    public function update(request $request)
    {

        // dd($request->all());
        $this->validate($request, [
            'supplier_id'   => 'required',
            'supplier_bill_no' => 'required',
            'dated' => 'required',
            'payment_mode' => 'required'
        ]);





        $invoice_no = $request->input('invoice_no');
        $purchase_bill = Finalpurchasebill::where('invoice_no', $invoice_no)->first();
        if (isset($purchase_bill)) {

            $purchase_bill->fill($request->all());
            if ($purchase_bill->save()) {


                $purchase_bill = Purchasebill::where('invoice_no', $invoice_no)->get();
                // dd($purchase_bill->toArray());
                foreach ($purchase_bill as $purchase) {

                    $product = Product::where('product_name', $purchase->product_name)->get();
                    foreach ($product as $products) {
                        $stock = (int)$products->product_stock - (int)$purchase->quantity;
                        $products->product_stock = $stock;
                        $products->save();
                    }
                }

                if (isset($purchase_bill)) {
                    for ($i = 0; $i < count($purchase_bill); $i++) {

                        $purchase_bill[$i]->delete();
                    }
                }


                for ($i = 0; $i < count($request->product_name); $i++) {
                    $purchase_bill = new Purchasebill();
                    // $purchase_bill = Purchasebill::where('invoice_no', $invoice_no)->first();

                    if ($request->supplier_state == '21') {
                        $purchase_bill_igst = "0";
                        $purchase_bill_sgst = $request->gst_amount[$i] / 2;
                        $purchase_bill_cgst = $request->gst_amount[$i] / 2;

                        $purchase_bill_igst_percent = "0";
                        $purchase_bill_sgst_percent = $request->cgst_percent[$i] / 2;
                        $purchase_bill_cgst_percent = $request->cgst_percent[$i] / 2;

                        $purchase_bill_igst_total = '0';
                        $purchase_bill_sgst_total = $request->final_igst_amount / 2;
                        $purchase_bill_cgst_total = $request->final_igst_amount / 2;
                    } else {
                        $purchase_bill_igst = $request->gst_amount[$i];
                        $purchase_bill_sgst = '0';
                        $purchase_bill_cgst = '0';

                        $purchase_bill_igst_percent = $request->cgst_percent[$i];
                        $purchase_bill_sgst_percent = '0';
                        $purchase_bill_cgst_percent = '0';

                        $purchase_bill_igst_total = $request->final_igst_amount;
                        $purchase_bill_sgst_total = '0';
                        $purchase_bill_cgst_total = '0';
                    }

                    $product_data = [
                        'invoice_no' => $request->purchase_bill_no,
                        'supplier_id' => $request->supplier_id,
                        'company_id' => $request->company_id,
                        'product_name' => $request->product_name[$i],
                        'hsn_code' => $request->hsn_code[$i],
                        // 'p_part_no' => $request->p_part_no[$i],
                        // 'p_custom_port_no' => $request->p_custom_port_no[$i],
                        'quantity' => $request->quantity[$i],
                        'rate' => $request->rate[$i],
                        'amount' => $request->amount[$i],
                        'product_unit' => $request->unit[$i],

                        'discount' => $request->discount[$i],
                        'row_total_gst' => $request->total_amount[$i],
                        'total_quantity' => $request->finalquantity,
                        'total_init_amount' => $request->finalamount,
                        'total_amount' => $request->finalgstamount,
                        'type' => 'p',

                        'igst' => $purchase_bill_igst,
                        'sgst' => $purchase_bill_sgst,
                        'cgst' => $purchase_bill_cgst,
                        'igst_percent' => $purchase_bill_igst_percent,
                        'sgst_percent' => $purchase_bill_sgst_percent,
                        'cgst_percent' => $purchase_bill_cgst_percent,
                        'igst_total' => $purchase_bill_igst_total,
                        'sgst_total' => $purchase_bill_sgst_total,
                        'cgst_total' => $purchase_bill_cgst_total

                    ];
                    $purchase_bill->fill($product_data);
                    $purchase_bill->save();
                }

                for ($i = 0; $i < count($request->product_name); $i++) {

                    $pro_q = Product::where('product_name', $request->product_name[$i])->first();
                    if (isset($pro_q->product_stock)) {

                        $product_quantity = (int)$pro_q->product_stock + (int)$request->quantity[$i];
                        $pro_q->product_stock = $product_quantity;
                        $pro_q->save();
                    } else {

                        $m_product = new Product();
                        $product_arr = [

                            'company_id' => $request->company_id,
                            'product_name' => $request->product_name[$i],
                            'hsn_code' => $request->hsn_code[$i],
                            'product_stock' => $request->quantity[$i],
                            'product_rate' => $request->rate[$i],
                            'product_unit' => $request->unit[$i],
                            'gst_percent' => $request->cgst_percent[$i],

                        ];

                        $m_product->fill($product_arr);
                        $m_product->save();
                    }
                }

                return redirect('admin/purchase/bill/')->with('message', 'Purchase Bill Updated Successfully');
            }
        }
    }


    public function delete($id)
    {

        $Final_purchase_bill = Finalpurchasebill::where('invoice_no', $id)->first();

        if (isset($Final_purchase_bill)) {
            // $Final_purchase_bill->delete();
            $purchase_bill = Purchasebill::where('invoice_no', $id)->get();

            foreach ($purchase_bill as $purchase) {

                $product = Product::where('product_name', $purchase->product_name)->get();
                foreach ($product as $products) {
                    $stock = (int)$products->product_stock - (int)$purchase->quantity;
                    $products->product_stock = $stock;

                    // dd($products->product_stock);
                    $products->save();
                }
            }

            for ($i = 0; $i < count($purchase_bill); $i++) {
                $purchase_bill[$i]->delete();
            }
            $Final_purchase_bill->delete();
        }
        return redirect('admin/purchase/bill/')->with('error', 'Purchase Bill Deleted Successfully');
    }

    public function details(Request $request)
    {
        // dd($request->all());
        $req = $request->post('select_val');
        // dd($req);
        $supplier = Supplier::where('supplier_id', $request->select_val)->first();
        // dd($supplier->toarray());

        $html = "Supplier Name:" . $supplier->s_name . "<br>";
        $html .= "Address:" . $supplier->s_address . "<br>";
        $html .= "Mobile:" . $supplier->s_mobile_no . "<br>";

        $test = "Branch Name:" . $supplier->s_branch_name . "<br>";
        $test .= "Bank Ifsc:" . $supplier->s_bank_ifsc . "<br>";
        $test .= "Account No:" . $supplier->s_account_no . "<br>";
        $test .= "supplier State:" . $supplier->s_state . "<br>";



        return [$html, $test, $supplier->s_state];
    }

    public function companydetails(Request $request)
    {
        $req = $request->post('select_val');
        // dd($req);
        // $product = Product::where('company_id', $request->select_val)->first();


        $company = Company::where('company_id', $request->select_val)->first();
        // dd($company->toarray());
        // $html = "Company Id:" . $company->company_id."<br>";

        $html = "Company Name:" . $company->company_name . "<br>";
        $html .= "Address:" . $company->company_address . "<br>";
        $html .= "Mobile:" . $company->cm_mobile . "<br>";

        $test = "Branch Name:" . $company->cm_bank_name . "<br>";
        $test .= "Bank Ifsc:" . $company->cm_branch_name . "<br>";
        $test .= "Account No:" . $company->cm_bank_ifsc . "<br>";
        $test .= "Account No:" . $company->cm_account_no . "<br>";



        return [$html, $test, $company->company_id];
    }

    public function productdetails(Request $request)
    {


        $product = Product::where('company_id', $request->select_val)->pluck('product_name', 'product_name');


        return $product;

        // return response()->json($html); 
    }

    public function producthsn(Request $request)
    {
        // $product = Product::where('product_id', $request->a)->get(['hsn_code','product_rate']);
        $product = Product::where('product_name', $request->select2_val)->first(['hsn_code', 'product_rate']);

        // dd($product->toArray());
        // return $product;
        echo json_encode($product);
    }



    public function editsupplierdetails(Request $request)
    {
        // dd($request->all());
        $req = $request->post('sup_val');
        $supplier = Supplier::where('supplier_id', $request->sup_val)->first();
        // dd($supplier->toarray());

        $html = "Supplier Name:" . $supplier->s_name . "<br>";
        $html .= "Address:" . $supplier->s_address . "<br>";
        $html .= "Mobile:" . $supplier->s_mobile_no . "<br>";

        $test = "Branch Name:" . $supplier->s_branch_name . "<br>";
        $test .= "Bank Ifsc:" . $supplier->s_bank_ifsc . "<br>";
        $test .= "Account No:" . $supplier->s_account_no . "<br>";
        $test .= "supplier State:" . $supplier->s_state . "<br>";



        return [$html, $test, $supplier->s_state];
    }


    public function paymentmode(Request $request)
    {
        // dd($request->all());
        $req = $request->post('Payment_val');
        $payment_details = Finalpurchasebill::where('payment_mode', $request->Payment_val)->where('invoice_no', '=', $request->invoice_no)->first();
        // dd($payment_details->toArray());

        $cheque_no = $payment_details->cheque_no;
        $bank_name = $payment_details->bank_name;
        $cheque_date = $payment_details->cheque_date;
        $electroni_payment = $payment_details->electronic_transaction_ref;





        return [$cheque_no, $bank_name, $cheque_date, $electroni_payment];
    }


    public function view($id)
    {


        $purchase_bill = Finalpurchasebill::where('invoice_no', $id)->with('Product_details', 'company', 'supplier')->first();


        // dd($purchase_bill->toArray());
        return view('backend.purchasebill.view', compact('purchase_bill'));
    }
}
