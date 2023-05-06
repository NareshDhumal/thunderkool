<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\Product;
use App\Models\backend\Tax;
use App\Models\backend\Unit;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all(); 
        
        return view('backend.Products.index',compact('products'));

    }
    public function create(){
        $company = Company::pluck('company_name', 'company_id');
        $gst_percent = Tax::pluck('gst_value', 'gst_value');
        $unit = Unit::pluck('unit', 'unit');

        // dd($company);
        return view('backend.Products.create',compact('company','gst_percent','unit'));
        
    }

    public function store(request $request){

        // dd($request->all());

        $this->validate($request,[
            'product_name' => 'required',
            'company_id' => 'required',
            'product_rate' => 'required',
            'product_stock' => 'required'
        ]);

        $products = new Product();
        $products->fill($request->all());
        $products->save();
        // return view('backend.Products.index');
        return redirect('admin/products/');
        
    }

    public function edit($id){
        $editdata = Product::where('product_id', $id)->first();
        // dd($editdata->toArray());
        $company = Company::pluck('company_name', 'company_id');
        $gst_percent = Tax::pluck('gst_value', 'gst_value');
        $unit = Unit::pluck('unit', 'unit');

        return view('backend.Products.edit',compact('editdata','company','gst_percent','unit'));
    }

    public function update(request $request)
    {
        $id = $request->input('product_id');
        $updatedata = Product::findOrFail($id);
        // $updatedata = Product::where('product_id', $id)->first();
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/products/');

    }

    public function delete($id)
    {
        $deletedata = Product::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/products/');

    }
}
