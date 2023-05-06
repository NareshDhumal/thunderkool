<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        // echo "hello";
        $company = Company::all();
        // dd($company->toArray());
        return view('backend.company.index', compact('company'));
    }
    public function create()
    {

        return view('backend.company.create');
    }

    public function store(request $request)
    {

        // dd($request->all());
        $validated = $this->validate($request, [
            'company_name' => 'required|unique:company,company_name',
            'company_address' => 'required',
            'cm_mobile' => 'required|digits:10',
            'company_logo' => 'required',
            'company_seal' => 'required',
            //    'cm_gst_no' => 'regex:/^(AB|DE|GH)[a-zA-Z0-9]{15}$/',
            // 'cm_gst_no' => 'regex:/^[a-zA-Z0-9](\d{15})$/',
            'bill_gst' => 'required',
            // 'cm_gst_no' => 'required',
            // 'cm_bank_name' => 'required',
            // 'cm_branch_name' => 'required',
            // 'cm_bank_ifsc' => 'required',
            'cm_account_no' => 'nullable|numeric',
            // 'cm_pan_no' => 'required'
        ]);



        $company = new Company();
        // if ($request->file('company_logo')) {
        //     $file = $request->file('company_logo');
        //     $destinationPath = 'public/companyimages/';
        //     // $file_name = time() . rand(1, 100) . "." . $file->getClientOriginalExtension();
        //     // $files->move($destinationPath, $file_name);

        //     $filename = time() . rand(1, 100) . "." . $file->getClientOriginalName();
        //     $file->move(public_path($destinationPath, $filename));
        //     $Company['company_logo'] = $filename;

        //     }
        $form_data = $request->all();
        // dd($form_data);

        if ($request->hasfile('company_logo')) {
            $file = $request->company_logo;
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '_', $filename);
            $file_path = $file->storeAs('/public/company_images', $filename);
            // dd($file_path);
            $form_data['company_logo'] = '/' . $file_path;
        }
        if ($request->hasfile('company_seal')) {
            $file = $request->company_seal;
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '_', $filename);
            $file_path = $file->storeAs('/public/company_images', $filename);
            // $company->company_seal = $file_path;
            $form_data['company_seal'] = '/' . $file_path;
        }
        $company->fill($form_data);
        $company->save();
        return redirect('admin/company/')->with('success', 'Company Created Successfully');;
    }

    public function edit($id)
    {
        $editdata = Company::where('company_id', $id)->first();

        // dd($editdata->toArray());
        return view('backend.company.edit', compact('editdata', 'id'));
    }

    public function update(request $request)
    {
        $validated = $this->validate($request, [
            'company_name' => 'required',
            'company_address' => 'required',
            'cm_mobile' => 'required|digits:10',
            // 'company_logo' => 'required',
            // 'company_seal' => 'required',
            // 'gst_no' => 'digits:15',
            'bill_gst' => 'required',
            // 'cm_gst_no' => 'required',
            // 'cm_bank_name' => 'required',
            // 'cm_branch_name' => 'required',
            // 'cm_bank_ifsc' => 'required',
            'cm_account_no' => 'nullable|numeric',
            // 'cm_pan_no' => 'required'
        ]);


        // if ($request->hasfile('company_logo')) {
        //     $validated = $this->validate($request, [
        //         'company_logo' => 'required',

        //     ]);
        // }

        $id = $request->input('company_id');
        $updatedata = Company::findOrFail($id);
        // dd($request->all());


        $updatedata->fill($request->all());
        if ($request->hasfile('company_logo')) {
            $file = $request->company_logo;
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '_', $filename);
            $file_path = $file->storeAs('/public/company_images', $filename);
            // dd($file_path);
            $updatedata['company_logo'] = '/' . $file_path;
        }
        if ($request->hasfile('company_seal')) {
            $file = $request->company_seal;
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '_', $filename);
            $file_path = $file->storeAs('/public/company_images', $filename);
            // dd($file_path);

            // $company->company_seal = $file_path;
            $updatedata['company_seal'] = '/' . $file_path;
        }

        $updatedata->save();
        return redirect('admin/company/')->with('message', 'Company Updated successfully');
    }

    public function delete($id)
    {
        $deletedata = Company::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/company/')->with('error', 'Company deleted successfully');
    }
}
