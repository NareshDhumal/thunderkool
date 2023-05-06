<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\Product;
use App\Models\backend\Productgroup;
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
        $product_name = Productgroup::pluck('group_name', 'group_id');

        // dd($company);
        return view('backend.Products.create', compact('company', 'gst_percent', 'unit', 'product_name'));
    }

    public function store(request $request)
    {

        // dd($request->all());

        $this->validate($request, [
            'product_name' => 'required|unique:products,product_name',
            'company_id' => 'required',
            'service_id' => 'required'
            // 'product_rate' => 'required',
            // 'product_stock' => 'required',
            // 'hsn_code' => 'required',
            // 'product_part_no' => 'required',
            // 'product_part_no_custom' => 'required',
            // 'product_unit' => 'required',
            // 'gst_percent' => 'required'
        ]);

        // $qty  = $request->Gram / $request->product_stock;



        $products = new Product();
        $data = $request->all();

        if ($request->product_unit == 'Nos') {
            // $products->product_stock = $request->product_stock;
            $data['product_stock'] = $request->product_stock;

            $data['product_unit'] = $request->product_unit;
            // $data->product_unit = $request->product_unit;

            // dd($data->product_stock);

        } else if ($request->product_unit == 'Gm') {

            $data['product_stock'] = $request->product_stock;
            $data['product_unit'] = $request->product_unit;
            // dd($data->product_stock);


        } else if ($request->product_unit == 'Lit') {

            $data['product_stock'] = $request->product_stock * 1000;
            $data['product_unit'] = 'Mil';
            // dd($data->unit);



        } else if ($request->product_unit == 'Kg') {

            $data['product_stock'] = $request->product_stock * 1000;
            $data['product_unit'] = 'Gm';
        } else if ($request->product_unit == 'Mil') {

            $data['product_stock'] = $request->product_stock * 1000;
            $data['product_unit'] = $request->product_unit;
            // dd($products->unit);


        }



        $products->fill($data);
        $products->save();
        return redirect('admin/products/')->with('success', 'Product Created Succsesfully');
    }

    public function edit($id)
    {
        $editdata = Product::where('product_id', $id)->first();
        // dd($editdata->toArray());
        // if ($editdata->product_unit == ){

        // }
        $company = Company::pluck('company_name', 'company_id');
        $gst_percent = Tax::pluck('gst_value', 'gst_value');
        $unit = Unit::pluck('unit', 'unit');

        return view('backend.Products.edit', compact('editdata', 'company', 'gst_percent', 'unit'));
    }

    public function update(request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|unique:products,product_name',
            'company_id' => 'required',
            'service_id' => 'required'
            // 'product_rate' => 'required',
            // 'product_stock' => 'required',
            // 'hsn_code' => 'required',
            // 'product_part_no' => 'required',
            // 'product_part_no_custom' => 'required',
            // 'product_unit' => 'required',
            // 'gst_percent' => 'required'
        ]);

        $id = $request->input('product_id');
        $updatedata = Product::findOrFail($id);
        // $updatedata = Product::where('product_id', $id)->first();
        if ($updatedata) {

            $data = $request->all();


            if ($request->product_unit == 'Nos') {
                // $products->product_stock = $request->product_stock;
                $data['product_stock'] = $request->product_stock;

                $data['product_unit'] = $request->product_unit;
                // $data->product_unit = $request->product_unit;

                // dd($data->product_stock);

            } else if ($request->product_unit == 'Gm') {

                $data['product_stock'] = $request->product_stock;
                $data['product_unit'] = $request->product_unit;
                // dd($data->product_stock);


            } else if ($request->product_unit == 'Lit') {

                $data['product_stock'] = $request->product_stock * 1000;
                $data['product_unit'] = 'Mil';
                // dd($data->unit);



            } else if ($request->product_unit == 'Kg') {

                $data['product_stock'] = $request->product_stock * 1000;
                $data['product_unit'] = 'Gm';
            } else if ($request->product_unit == 'Mil') {

                $data['product_stock'] = $request->product_stock * 1000;
                $data['product_unit'] = $request->product_unit;
                // dd($products->unit);


            }
        }
        $updatedata->fill($data);
        $updatedata->save();

        // $updatedata->fill($request->all());
        // $updatedata->save();
        return redirect('admin/products/')->with('message', 'Product Updated Succsesfully');
    }

    public function delete($id)
    {
        $deletedata = Product::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/products/')->with('error', 'Product Deleted Succsesfully');
    }
}
