<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Product;
use App\Models\backend\Productgroup;
use Illuminate\Http\Request;

class GroupingController extends Controller
{
    public function index()
    {

        $products = Product::with('group')->get();
        // dd($products->toArray());
        $product_name = Productgroup::pluck('group_name', 'group_id');

        return view('backend.Grouping.index', compact('products', 'product_name'));
    }

    public function selected_product(Request $request){
        // $data = $request->all();
        // $group_id = $request->group_id;
        $p_id = $request->vals;

        foreach ($p_id as $ids) {

            $products = Product::where('product_id',$ids)->first();
            if($products){
                $products->group_id = $request->group_id;
                $products->save();
            }
           
        }




        return true;
    }

    public function selected_product_unassign(Request $request){
        // $data = $request->all();
        // $group_id = $request->group_id;
        $p_id = $request->vals;

        foreach ($p_id as $ids) {

            $products = Product::where('product_id',$ids)->first();
            if($products){
                $products->group_id = null;
                $products->save();
            }
           
        }




        return true;
    }
}
