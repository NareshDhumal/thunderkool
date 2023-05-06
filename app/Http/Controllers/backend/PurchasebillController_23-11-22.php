<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\Finalpurchasebill;
use App\Models\backend\Product;
use App\Models\backend\Purchasebill;
use App\Models\backend\Supplier;
use App\Models\backend\Tax;
use App\Models\backend\Unit;

use App\Models\backend\Paymentmode;
use App\Models\backend\Unit as BackendUnit;
use Illuminate\Http\Request;
// use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class PurchasebillController extends Controller
{
    public function index()
    {
        // $purchase_bill = Purchasebill::all();
        // // dd($purchase_bill);
        // return view('backend.purchasebill.index',compact('purchase_bill'));
        return view('backend.purchasebill.index');
    }
    public function create()
    {
        $data = Supplier::all();
        $supplier = Supplier::pluck('s_name', 'supplier_id');
        $products = Product::pluck('product_name', 'product_id');
        $p_unit = Unit::pluck('unit', 'unit');
        $comapany = Company::pluck('company_name', 'company_id');
        $gst_percent = Tax::pluck('gst_value', 'gst_value');
        $payment_mode = Paymentmode::pluck('payment_mode', 'payment_mode');

        // dd($payment_mode);

        return view('backend.purchasebill.create', compact('supplier', 'comapany', 'gst_percent', 'products', 'data', 'payment_mode', 'p_unit'));

    }

    public function store(request $request)
    {
        dd($request->all());
        // $this->validate($request,[

        // ]);
        $final_purchase_bill = new Finalpurchasebill();


        // if($request->payment_mode == 'cash'){
        //     $final_purchase_bill->cash = '1';
        //     $final_purchase_bill->cheque = '0';
        //     $final_purchase_bill->electronic_transaction = '0';

        // }else if($request->payment_mode == 'cheque'){
        //     $final_purchase_bill->cash = '0';
        //     $final_purchase_bill->cheque = '1';
        //     $final_purchase_bill->electronic_transaction = '0';
        // }
        // else if($request->payment_mode == 'Epayment'){
        //     $final_purchase_bill->cash = '0';
        //     $final_purchase_bill->cheque = '0';
        //     $final_purchase_bill->electronic_transaction = '1';
        // }


        $data = [
            'supplier_id' => $request->supplier_id,
            'company_id' => $request->company_id,
            'supplier_bill_no' => $request->supplier_bill_no,
            'dated' => $request->dated,
            'payment_mode' => $request->payment_mode,
            'cheque_no' => $request->cheque_no,
            'bank_name' => $request->bank_name,
            'cheque_date' => $request->cheque_date,
            'electronic_transaction_ref' => $request->electronic_payment_ref
        ];
        $final_purchase_bill->fill($data);


        if ($final_purchase_bill->save()) {
            for ($i = 0; $i < count($request->product_name); $i++) {
                # code...
                $purchase_bill = new Purchasebill();
                $product_data = [
                    'supplier_id' => $request->supplier_id,
                    'company_id' => $request->company_id,
                    'product_name' => $request->product_name[$i],
                    'hsn_code' => $request->hsn_code[$i],
                    'p_part_no' => $request->p_part_no[$i],
                    'p_custom_port_no' => $request->p_custom_port_no[$i],
                    'quantity' => $request->quantity[$i],
                    'rate' => $request->rate[$i],
                    'amount' => $request->amount[$i],
                    'cgst_percent' => $request->cgst_percent[$i],
                    'product_unit' => $request->product_unit[$i],
                    'total_amount' => $request->total_amount[$i]

                ];
                $purchase_bill->fill($product_data);
                $purchase_bill->save();
            }
            return redirect('admin/purchase/bill/');
        }
    }

    public function edit($id)
    {
        $editdata = Purchasebill::where('gst_id', $id)->first();
        return view('backend.purchasebill.edit', compact('editdata'));
    }

    public function update(request $request)
    {
        $id = $request->input('gst_id');
        $updatedata = Purchasebill::findOrFail($id);
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/purchase/bill/');

    }

    public function delete($id)
    {
        $deletedata = Purchasebill::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/purchase/bill/');

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


        return [$html, $test];


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
        // dd($request->all());
       
        // $product = Product::where('company_id', $request->select_val)->get(['product_id','product_name']);
        // $product = Product::where('company_id', $request->select_val)->get();

        $product = Product::where('company_id', $request->select_val)->pluck('product_name','product_id');
        // dd($product->toarray());
        // $options = "<option value=''>Please Select</option>";
        // foreach ($product as $key => $products) {
        //     $options .= "<option value='" . $products['product_id'] . "'>" . $products['product_name'] . "</option>";
        //   }
//   dd($options);
    //    $product = collect(Product::where('company_id', $request->select_val)->get())->mapWithKeys(function ($item, $key) {
    //     return [$item['product_id'] => $item['product_name']];
    //     // return [$item['product_id'] => $item['product_name']];
    //   });
        // dd($product);
        return $product;

        // return response()->json($html); 
    }

    public function producthsn(Request $request)
    {
        // dd($request->all());
        // $product = Product::where('product_id', $request->a)->get(['hsn_code','product_rate']);
        $product = Product::where('product_id', $request->select2_val)->first(['hsn_code','product_rate']);
       
        // dd($product->toArray());
        // return $product;
        echo json_encode($product);



        // if($request->supplier_state == '21')
        // {
        //     $purchase_bill->igst = "";
        //     $purchase_bill->cgst = $request->gst_amount[$i]/2;
        //     $purchase_bill->cgst = $request->gst_amount[$i]/2;
        //     $purchase_bill->igst_percent="";
        //     $purchase_bill->sgst_percent = $request->cgst_percent[$i]/2;
        //     $purchase_bill->cgst_percent = $request->cgst_percent[$i]/2;
        //     $purchase_bill->igst_total = '';
        //     $purchase_bill->sgst_total = $request->final_igst_amount[$i]/2;
        //     $purchase_bill->cgst_total = $request->final_igst_amount[$i]/2;
        // }
        // else
        //     {
        //         $igst_amount=$request->gst_amount[$i];
        //         $sgst_amount='';
        //         $cgst_amount='';
        //         $igst_percent=$request->cgst_percent[$i];
        //         $sgst_percent='';
        //         $cgst_percent='';
        //         $igst_total=$request->final_igst_amount[$i];
        //         $sgst_total='';
        //         $cgst_total='';
        //     }
    }
}