<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Productgroup;
use Illuminate\Http\Request;

class Groupcontroller extends Controller
{
    public function index(){
        $productgroup = Productgroup::all();
        return view('backend.productgroup.index',compact('productgroup'));

    }
    public function create(){

        return view('backend.productgroup.create');        
    }

    public function store(request $request){

        $this->validate($request,[
            'group_name' => 'required|regex:/^[a-zA-Z0-9_\s]*$/|unique:product groups,group_name',
            
        ]);

        $productgroup = new Productgroup();
        $productgroup->fill($request->all());
        $productgroup->save();
        return redirect('admin/productgrouping')->with('success','Group Created Succesfully');
        
    }

    public function edit($id){
        $productgroup = Productgroup::where('group_id', $id)->first();
        return view('backend.productgroup.edit',compact('productgroup'));
    }

    public function update(request $request)
    {
        $this->validate($request,[
            'group_name' => 'required|regex:/^[a-zA-Z\s]*$/',

          

        ]);
        
        $id = $request->input('group_id');
        $productgroup = Productgroup::findOrFail($id);
        $productgroup->fill($request->all());
        $productgroup->save();
        return redirect('admin/productgrouping')->with('message','Group Created Succesfully');

    }

    public function delete($id)
    {
        $productgroup = Productgroup::findOrFail($id);
        $productgroup->delete();
        return redirect('admin/productgrouping')->with('error','Group Deleted Succesfully');

    }
}
