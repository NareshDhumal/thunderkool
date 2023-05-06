<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\Customers;
use App\Models\backend\Finalpurchasebill;
use App\Models\backend\Invoice;
use App\Models\backend\Product;
use App\Models\backend\Productgroup;
use App\Models\backend\ProductInvoice;
use App\Models\backend\Supplier;
use App\Models\backend\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PHPUnit\TextUI\XmlConfiguration\Groups;

class ReportsController extends Controller
{
    // public function productstock()
    // {
    //     $product_stock = Product::with('group')->get();
    //     // dd($product_stock->toArray());

    //     return view('backend.reports.product_stock', compact('product_stock'));
    // }
    public function productstock(Request $request)
    {
        // $product_stock = Product::with('group')->get();
        // dd($product_stock->toArray());

        $product = Product::with('group');
        $group = Productgroup::pluck('group_name', 'group_id');
        $companies = Company::pluck('company_name', 'company_id');


        if (isset($request->group_id) && $request->group_id != '') {
            $product->where('group_id', $request->group_id);
        }
        if (isset($request->company_id) && $request->company_id != '') {
            $product->where('company_id', $request->company_id);
        }

        $product_stock = $product->get();


        return view('backend.reports.product_stock', compact('product_stock', 'group', 'companies'));
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
        // $invoice = Invoice::get();
        // dd($invoice[0]->Product);



        $invoice_data = Invoice::orderBy('invoice_id', 'DESC');
        // $invoice_data = Invoice::with('productsInvoice');

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

    public function vehicle_customerreports(Request $request)
    {
        $invoice_data = Invoice::orderBy('invoice_id', 'DESC');
        // $invoice_data = Invoice::with('productsInvoice');

        if (isset($request->vehicle_id) && $request->vehicle_id != '') {

            $invoice_data->where('vehicle_number', $request->vehicle_id);
        }
        if (isset($request->customer_id) && $request->customer_id != '') {

            $invoice_data->where('customer_id', $request->customer_id);
        }
        if (isset($request->start_date) && isset($request->end_date)) {

            $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date);
            $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date);

            $invoice_data->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate);
        }


        $invoice = $invoice_data->get();
        $customers = Customers::pluck('customer_name', 'customer_id');
        $vehicle = Vehicle::pluck('vehicle_no', 'vehicle_no');

        return view('backend.reports.vehicle_and_customer_report', compact('vehicle', 'customers', 'invoice'));
    }

    public function customer_productreports(Request $request)
    {
        // $invoice_data = Invoice::with('productsInvoice');
        $invoice = [];
        if (count($request->all())) {
            $invoice_data = Invoice::orderBy('invoice_id', 'DESC');
            if (isset($request->customer_id) && $request->customer_id != '') {

                $invoice_data->where('customer_id', $request->customer_id);
            }
            if (isset($request->start_date) && isset($request->end_date)) {

                $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date);
                $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date);

                $invoice_data->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate);
            }


            $invoice = $invoice_data->get();
        }
        // $product_invoice = ProductInvoice::Where('invoice_id',$invoice->invoice_id)->get();
        // dd($product_invoice);
        $customers = Customers::pluck('customer_name', 'customer_id');

        return view('backend.reports.customer_wise_product_report', compact('customers', 'invoice'));
    }

    public function purchasebill_supplierreport(Request $request)
    {
        $purcase_bill = [];
        if (count($request->all())) {
            $purchesebill_data = Finalpurchasebill::orderBy('id', 'DESC');
            if (isset($request->supplier_id) && $request->supplier_id != '') {

                $purchesebill_data->where('supplier_id', $request->supplier_id);
            }
            if (isset($request->start_date) && isset($request->end_date)) {

                $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date);
                $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date);

                $purchesebill_data->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate);
            }


            $purcase_bill = $purchesebill_data->get();
        }
        // $product_invoice = ProductInvoice::Where('invoice_id',$invoice->invoice_id)->get();
        // dd($product_invoice);
        $supplier = Supplier::pluck('s_name', 'supplier_id');

        return view('backend.reports.purchasebill_supplier_wise_report', compact('supplier', 'purcase_bill'));
    }
}
