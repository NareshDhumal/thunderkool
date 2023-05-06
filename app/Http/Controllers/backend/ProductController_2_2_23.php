<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all(); 
        return view('backend.Products.index',compact('products'));

    }
    public function create(){
        
        return view('backend.Products.create');
        
    }

    public function store(request $request){

        $this->validate($request,[
            'product_name' => 'required',
            'company_name' => 'required',
            'product_rate' => 'required',
            'product_stock' => 'required'
        ]);

        $products = new Product();
        $products->fill($request->all());
        $products->save();
        return view('backend.Products.index');
        
    }

    public function edit($id){
        $editdata = Product::where('product_id', $id)->first();
        return view('backend.Products.edit',compact('editdata'));
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
