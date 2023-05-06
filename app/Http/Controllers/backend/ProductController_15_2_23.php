<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\Product;
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
        $unit = Unit::pluck('unit', 'unit');

        // dd($company);
        return view('backend.Products.create', compact('company', 'gst_percent', 'unit'));
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


            if ($data) {
                if ($data->unit == 'Nos') {

                    $qty_total = (int)$data->qty + (int)$request->product_stock;
                    // $data->qty = $qty_total;
                    // $data->save();
                } else if ($data->unit == 'Gm') {
               
                    $qty_total = $data->qty + $request->grams;
                    // $data->qty = $qty_total;
                    // $data->save();

                }
                    $data->qty = $qty_total;
                    $data->save();

            } else {

                // dd($request->all());

                $qty = new Quentity;
                if($request->product_unit == 'Nos'){
                    $qty->qty = $request->product_stock;
                    // dd($qty->qty);
                  
                }else if($request->product_unit == 'Gm'){

                    $qty->qty = $request->grams;
                    // dd($qty->qty);


                   
                }
                $qty->product_part_no = (int)$request->product_part_no;
                $qty->unit = $request->product_unit;
                    // dd($qty);

                $qty->save();



                // if(isset($data->product_part_no) && isset($data->product_unit == 'Nos'))
                // {
                //     $qty_total = (int)$data->qty + (int)$request->product_stock;
                //     $data->qty = $qty_total;
                //     // dd('in if');
                //     // dd($data->qty);

                //     $data->save();
                // }else{

                //     //  dd('in else');
                // $qty = new Quentity;
                // // dd($qty);
                // $qty->qty = $request->product_stock;
                // $qty->product_part_no = (int)$request->product_part_no;
                // $qty->unit = $request->product_unit;

                // // dd($qty->product_part_no);
                // // echo "<pre>";
                // // dd($qty);
                // // print_r($qty);
                // $qty->save();

                // dd($qty);
                // $search_qty = Quentity::where('qty_id',$qty->qty_id)->get();
                // dd($search_qty);
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
        $deletedata = Product::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/products/')->with('error', 'Product Deleted Succsesfully');
    }
}
