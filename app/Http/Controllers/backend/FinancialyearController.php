<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Financialyear;
use App\Models\backend\Tax;
use Illuminate\Http\Request;

class FinancialyearController extends Controller
{
    public function index()
    {
        $financial = Financialyear::all();
        // dd($financial);
        return view('backend.financialyear.index', compact('financial'));
    }
    public function create()
    {

        return view('backend.financialyear.create');
    }

    public function store(request $request)
    {

        // dd($request->all());

        $this->validate($request, [
            'financial_year' => 'required|unique:financial_year,financial_year',
            'financial_start_year' => 'required',
            'financial_end_year' => 'required'

        ]);
        $cheak_financial_year = Financialyear::where('default_flag', 1)->get();

        if (!$cheak_financial_year->isEmpty()) {

            return redirect()->back()->with('error', 'Please Uncheak The Previous Year');
        } else {

            $financial = new Financialyear();
            $financial->fill($request->all());
            $financial->save();
            return redirect('admin/financial/year')->with('success', 'Financial Year Created Succesfully');
        }
    }

    public function edit($id)
    {
        $editdata = Financialyear::where('financial_year_id', $id)->first();
        return view('backend.financialyear.edit', compact('editdata'));
    }

    public function update(request $request)
    {
        $this->validate($request, [
            'financial_year' => 'required',
            'financial_start_year' => 'required',
            'financial_end_year' => 'required'

        ]);

        $id = $request->input('financial_year_id');
        $updatedata = Financialyear::findOrFail($id);
        // $updatedata = tax::where('tax_id', $id)->first();
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/financial/year/')->with('message', 'Financial year Updated Succesfully');
    }

    public function delete($id)
    {
        $financialyear = Financialyear::findOrFail($id);
        if ($financialyear->default_flag == 1) {

            // $last_invoice = Financialyear::orderBy('financial_year_id', 'DESC')->get()->toArray();

            $last_financialyear = Financialyear::orderBy('financial_year_id', 'DESC')->first();
            $last_financialyear = $last_financialyear->financial_year_id - 1;

            $set_year = Financialyear::where('financial_year_id', $last_financialyear)->first();
            $set_year->default_flag  = $set_year->default_flag = 1;
            $set_year->save();
            // dd($set_year->default_flag);


        }
        $financialyear->delete();
        return redirect('admin/financial/year/')->with('error', 'Financial Year Deleted Succesfully');
    }

    // public function delete($id)
    // {
    //     $deletedata = Financialyear::findOrFail($id);
    //     $deletedata->delete();
    //     return redirect('admin/financial/year/');

    // }
}
