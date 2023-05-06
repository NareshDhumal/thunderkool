<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        // echo "hello";
        $company = Company::all();
        // dd($company->toArray());
        return view('backend.company.index',compact('company'));

    }
    public function create(){

        return view('backend.company.create');        
    }

    public function store(request $request){
        // dd($request->toArray());
        $this->validate($request,[
            'company_name' => 'required',
            'company_address' => 'required',
            'cm_mobile' => 'required',
            'company_logo' => 'required',
            'company_seal' => 'required',
            // 'gst_no' => 'required',
            'cm_gst_no' => 'required',
            'cm_bank_name' => 'required',
            'cm_branch_name' => 'required',
            'cm_bank_ifsc' => 'required',
            'cm_account_no' => 'required',
            'cm_pan_no' => 'required'
        ]);

  

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
        if($request->hasfile('company_logo'))
        {
            $file = $request->company_logo;
            $filename = $file->getClientOriginalName();
            $file->storeAs('public\company_images', $filename);
            // $image_save->company_logo = $filename;


            $doc_data = array(
              
                'company_logo' => $filename
            );
          

            $Company = new Company();
            $Company->fill($doc_data);
            $Company->save();
        }

            return redirect('admin/company/');
        
    }

    public function edit($id){
        $editdata = Company::where('company_id', $id)->first();
        return view('backend.company.edit',compact('editdata'));
    }

    public function update(request $request)
    {
        $id = $request->input('company_id');
        $updatedata = Company::findOrFail($id);
        $updatedata->fill($request->all());
        $updatedata->save();
        return redirect('admin/company/');

    }

    public function delete($id)
    {
        $deletedata = Company::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/company/');

    }
}
