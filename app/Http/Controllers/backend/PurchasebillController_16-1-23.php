<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\Finalpurchasebill;
use App\Models\backend\Product;
use App\Models\backend\Purchasebill;
use App\Models\backend\Supplier;
use App\Models\backend\Tax;
use App\Models\backend\Paymentmode;

use Illuminate\Http\Request;

class PurchasebillController extends Controller
{
    public function index(){
        echo "hello";
        // $purchase_bill = Purchasebill::all();
        // // dd($purchase_bill);
        // return view('backend.purchasebill.index',compact('purchase_bill'));

    }
    public function create(){
        $data = Supplier::all();
        $supplier = Supplier::pluck('s_name', 'supplier_id');
        $products = Product::pluck('product_name', 'product_id');
        $comapany = Company::pluck('company_name' , 'company_id');
        $gst_percent = Tax::pluck('gst_value' , 'gst_id');
        $payment_mode = Paymentmode::pluck('payment_mode','payment_mode');
        // dd($payment_mode);

        return view('backend.purchasebill.create',compact('supplier','comapany','gst_percent','products','data','payment_mode'));

    }

    public function store(request $request){
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

            $purchase_bill = new Purchasebill();
            $product_data = [
            'supplier_id' => $request->supplier_id,
            'company_id' => $request->company_id

            ];
            $purchase_bill->fill($request->all());
            $purchase_bill->save();
        }
        return redirect('admin/purchase/bill/');
        
    }

    public function edit($id){
        $editdata = Purchasebill::where('gst_id', $id)->first();
        return view('backend.purchasebill.edit',compact('editdata'));
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

    public function details(Request $request){
        // dd($request->all());
        $req = $request->post('select_val');
        // dd($req);
        $supplier = Supplier::where('supplier_id',$request->select_val)->first();
        // dd($supplier->toarray());
       
        $html = "Supplier Name:" . $supplier->s_name."<br>";
        $html .= "Address:" .$supplier->s_address."<br>";
        $html .= "Mobile:" .$supplier->s_mobile_no."<br>";

        $test = "Branch Name:" .$supplier->s_branch_name."<br>";
        $test .= "Bank Ifsc:" .$supplier->s_bank_ifsc."<br>";
        $test .= "Account No:" .$supplier->s_account_no."<br>";

     
        return [$html,$test];


        }

        public function companydetails(Request $request){
                        $req = $request->post('select_val');
        // dd($req);
        $company = Company::where('company_id',$request->select_val)->first();
        // dd($company->toarray());
        
        $html = "Company Name:" . $company->company_name."<br>";
        $html .= "Address:" .$company->company_address."<br>";
        $html .= "Mobile:" .$company->cm_mobile."<br>";

        $test = "Branch Name:" .$company->cm_bank_name."<br>";
        $test .= "Bank Ifsc:" .$company->cm_branch_name."<br>";
        $test .= "Account No:" .$company->cm_bank_ifsc."<br>";
        $test .= "Account No:" .$company->cm_account_no."<br>";


        
        return [$html,$test];
        }
}
