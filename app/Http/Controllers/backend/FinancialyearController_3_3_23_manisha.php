<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Financialyear;
use App\Models\backend\Tax;
use Illuminate\Http\Request;

class FinancialyearController extends Controller
{
    public function index(){
        $financial = Financialyear::all();
        // dd($financial);
        return view('backend.financialyear.index',compact('financial'));

    }
    public function create(){

        return view('backend.financialyear.create');        
    }

    public function store(request $request){

        $this->validate($request,[
            'financial_year' => 'required|unique:financial_year,financial_year',
            'financial_start_year' => 'required',
            'financial_end_year' => 'required'

        ]);

        $financial = new Financialyear();
        $financial->fill($request->all());
        $financial->save();
        return redirect('admin/financial/year')->with('success','Financial Year Created Succesfully');
        
    }

    public function edit($id){
        $editdata = Financialyear::where('financial_year_id', $id)->first();
        return view('backend.financialyear.edit',compact('editdata'));
    }

    public function update(request $request)
    {
        $this->validate($request,[
            'financial_year' => 'required|unique:financial_year,financial_year',
            'financial_start_year' => 'required',
            'financial_end_year' => 'required'

        ]);
        
        $id = $request->input('financial_year_id');
        $updatedata = Financialyear::findOrFail($id);
        // $updatedata = tax::where('tax_id', $id)->first();
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/financial/year/')->with('message','Financial year Updated Succesfully');

    }

    public function delete($id)
    {
        $deletedata = Financialyear::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/financial/year/')->with('error','Financial Year Deleted Succesfully');

    }
}