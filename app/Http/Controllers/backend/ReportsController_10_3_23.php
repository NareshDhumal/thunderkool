<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\Finalpurchasebill;
use App\Models\backend\Invoice;
use App\Models\backend\Product;
use App\Models\backend\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ReportsController extends Controller
{
    public function productstock()
    {
        $product_stock = Product::all();
        //    dd($product_stock->toArray());

        return view('backend.reports.product_stock', compact('product_stock'));
    }

    // public function Purchasereports()
    // {
    //     $purcase_reports = Finalpurchasebill::with('company', 'supplier', 'Product_details')->get();
    //     $company = Company::pluck('company_name', 'company_id');
    //     $supplier = Supplier::pluck('s_name', 'supplier_id');

    //     // dd($company);
    //     // dd($purcase_reports->toArray());
    //     return view('backend.reports.purchase_reports', compact('purcase_reports', 'company'));
    // }

    public function Purchasereports(Request $request)
    {



        $purcase = Finalpurchasebill::with('company', 'supplier', 'Product_details');
        $company = Company::pluck('company_name', 'company_id');
        $supplier = Supplier::pluck('s_name', 'supplier_id');




        if (isset($request->company_id) && $request->company_id != '') {

            $purcase->where('company_id', $request->company_id);
        }

        if (isset($request->supplier_id) && ($request->supplier_id != '')) {

            $purcase->where('supplier_id', $request->supplier_id);
        }

        if (isset($request->start_date) && isset($request->end_date)) {

            $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date);
            $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date);

            $purcase->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate);
        }






        $purcase_reports = $purcase->get();
        // dd($purcase_reports->toArray());


        return view('backend.reports.purchase_reports', compact('purcase_reports', 'company', 'supplier', 'request'));
    }


    //         ->whereDate('created_at', '<=', $endDate)->with('company', 'supplier', 'Product_details')->get();
    // dd($purcase_reports->toArray());
    // if ($request->company_id != '') {
    //     $purcase_reports = Finalpurchasebill::where('company_id', $request->company_id)->with('company', 'supplier', 'Product_details')->get();

    //     // dd('ok');
    // } else if ($request->supplier_id != '') {
    //     $purcase_reports = Finalpurchasebill::where('supplier_id', $request->supplier_id)->with('company', 'supplier', 'Product_details')->get();

    // } else if ($request->supplier_id != '' && $request->company_id != '') {
    //     dd('ok');
    //     $purcase_reports = Finalpurchasebill::where('supplier_id', $request->supplier_id)->with('company', 'supplier', 'Product_details')->get();

    // }else {
    //     $purcase_reports = Finalpurchasebill::with('company', 'supplier', 'Product_details')->get();

    // }


    public function productgstreports()
    {

        $gst_reports  = Product::all();
        // dd($reports->purchasebill->toArray());


        return view('backend.reports.product_gst_report', compact('gst_reports'));
    }

    // public function invoicereport()
    // {

    //     $invoice = Invoice::orderBy('invoice_id', 'DESC')->get();
    //     $companies = Company::pluck('company_name', 'company_id');
    //     return view('backend.reports.invoice_report', compact('invoice', 'companies'));
    // }


    public function invoicereport(Request $request)
    {

        $invoice_data = Invoice::orderBy('invoice_id', 'DESC');

        if (isset($request->company_id) && $request->company_id != '') {

            $invoice_data->where('company_id', $request->company_id);
        }
        if (isset($request->start_date) && isset($request->end_date)) {

            $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date);
            $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date);

            $invoice_data->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate);
        }


        $invoice = $invoice_data->get();

        $companies = Company::pluck('company_name', 'company_id');
        return view('backend.reports.invoice_report', compact('invoice', 'companies'));
    }

    // public function reports(Request $request){
    //     // dd($request->all());
    //     if($request->input('submit_company')){
    //     $purcase_reports = Finalpurchasebill::where('company_id',$request->company_id)->with('company', 'supplier', 'Product_details')->get();
    //     $company = Company::pluck('company_name','company_id');

    //     return view('backend.reports.purchase_reports',compact('purcase_reports','company'));

    //     } else if($request->input('submitsupplier')){

    //         $purcase_reports = Finalpurchasebill::where('supplier_id',$request->supplier_id)->with('company', 'supplier', 'Product_details')->get();
    //         // dd($purcase_reports->toArray());
    //         $company = Company::pluck('company_name','company_id');
    //         // $supplier = Supplier::pluck('s_name','supplier_id');


    //         return view('backend.reports.purchase_reports',compact('purcase_reports','company'));
    //     }

    // }
}
