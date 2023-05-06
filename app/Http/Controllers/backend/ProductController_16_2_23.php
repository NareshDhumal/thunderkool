<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\Invoice;
use App\Models\backend\Product;
use App\Models\backend\Productgroup;
use App\Models\backend\ProductInvoice;
use App\Models\backend\Purchasebill;
use App\Models\backend\Quentity;
use App\Models\backend\Tax;
use App\Models\backend\Unit;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('company')->get();
        // dd($products->toArray());

        return view('backend.Products.index', compact('products'));
    }
    public function create()
    {
        $company = Company::pluck('company_name', 'company_id');
        $gst_percent = Tax::pluck('gst_value', 'gst_value');
        $unit = Unit::pluck('unit', 'P_unit_id');
        $product_name =Productgroup::pluck('group_name','group_id');

        // dd($product_name);

        // dd($company);
        return view('backend.Products.create', compact('company', 'gst_percent', 'unit', 'product_name'));
    }

    public function store(request $request)
    {

        // dd($request->all());



        $this->validate($request, [
            'product_name' => 'required|unique:products,product_name',
            'company_id' => 'required',
            'product_rate' => 'required',
            // 'product_stock' => 'required',
            'hsn_code' => 'required',
            // 'product_part_no' => 'required',
            // 'product_part_no_custom' => 'required',
            'product_unit' => 'required',
            'gst_percent' => 'required'
        ]);


        $product_part_no = $request->product_part_no;

        // dd($request->product_part_no);
        $products = new Product();
        $products->fill($request->all());
        // $products->save();

        if ($products->save()) {


            $data = Quentity::where('product_part_no', $request->product_part_no)->first();

            // dd($data->toarray());
        // dd($request->all());


            if ($data) {
                if ($data->unit == '1') {

                    $qty_total = (int)$data->qty + (int)$request->product_stock;
                    // $data->qty = $qty_total;
                    // $data->save();
                } else if ($data->unit == '2') {

                    if($request->grams){

                        $qty_total = $data->qty + $request->grams;

                    }
                    if($request->kilogram){

                        $qty_total = $data->qty + $request->kilogram * 1000;
                    }
                    // $data->qty = $qty_total;
                    // $data->save();

                } else if ($data->unit == '3') {


                    if($request->mil){

                        $qty_total = $data->qty + $request->mil;

                    }
                    if($request->liter){

                        $qty_total = $data->qty + $request->liter * 1000;
                    }
                    

                    // $data->qty = $qty_total;
                    // $data->save();
                    // dd($qty_total);


                } else if ($data->unit == '4') {

                    $qty_total = $data->qty + $request->kilogram * 1000;
                    // $data->qty = $qty_total;
                    // $data->save();
                    // dd($qty_total);

                }else if ($data->unit == '5') {

                    $qty_total = $data->qty + $request->liter * 1000;
                    // $data->qty = $qty_total;
                    // $data->save();
                    // dd($qty_total);

                }
                $data->qty = $qty_total;
                $data->save();
            } else {

                // dd($request->all());

                $qty = new Quentity;
                if ($request->product_unit == '1') {
                    $qty->qty = $request->product_stock;
                    $qty->unit = $request->product_unit;

                    // dd($qty->qty);

                } else if ($request->product_unit == '2') {

                    $qty->qty = $request->grams;
                    $qty->unit = $request->product_unit;

                    // dd($qty->qty);



                } else if ($request->product_unit == '5') {

                    $qty->qty = $request->liter * 1000;
                    $qty->unit = '3';


                    
                } else if ($request->product_unit == '4') {

                    $qty->qty = $request->kilogram * 1000;
                    $qty->unit = '2';


                }else if ($request->product_unit == '3') {

                    $qty->qty = $request->kilogram * 1000;
                    $qty->unit = $request->product_unit;


                }

                $qty->product_part_no = (int)$request->product_part_no;
                // $qty->unit = $request->product_unit;
                // dd($qty);

                $qty->save();



            
            }
        }

        // return view('backend.Products.index');
        return redirect('admin/products/')->with('success', 'Product Created Succsesfully');
    }


    public function edit($id)
    {
        $editdata = Product::where('product_id', $id)->first();
        // dd($editdata->toArray());
        $company = Company::pluck('company_name', 'company_id');
        $gst_percent = Tax::pluck('gst_value', 'gst_value');
        $unit = Unit::pluck('unit', 'unit');

        return view('backend.Products.edit', compact('editdata', 'company', 'gst_percent', 'unit'));
    }

    public function update(request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'company_id' => 'required',
            'product_rate' => 'required',
            // 'product_stock' => 'required',
            'hsn_code' => 'required',
            // 'product_part_no' => 'required',
            // 'product_part_no_custom' => 'required',
            'product_unit' => 'required',
            'gst_percent' => 'required'
        ]);

        $id = $request->input('product_id');
        $updatedata = Product::findOrFail($id);
        // $updatedata = Product::where('product_id', $id)->first();
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/products/')->with('message', 'Product Updated Succsesfully');
    }

    public function delete($id)
    {
        $product = Product::where('product_id', $id)->first();


        $purchasebiil_product = Purchasebill::where('product_name', $product->product_name)->get();
        $product_invoice = ProductInvoice::where('product_description', $product->product_name)->get();

        if (count($purchasebiil_product) > 0 || count($product_invoice) > 0) {

            return back()->with('error', 'Product Is Already In Use');
     

        } else {
            $deletedata = Product::findOrFail($id);
            $deletedata->delete();
        }


        // $deletedata = Product::findOrFail($id);
        // $deletedata->delete();
        // return redirect('admin/products/')->with('error', 'Product Deleted Succsesfully');
    }


    public function partno(Request $request){

        $resp  =  $request->post('unit');

        $p_qty = Quentity::where('product_part_no', $request->unit)->first();
        
        if(isset($p_qty)){
            $unit = $p_qty->unit;


                }

        return[$unit];

    }
}
