<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Questions;
use Illuminate\Http\Request;


class QuestionController extends Controller
{

    public function index()
    {

        $data = Questions::all();
        return view('backend.crud.index', compact('data'));
    }


public function create(){
        return view('backend.crud.create');
}
    public function store(request $request)
    {
        // dd($request->all());
       
        // $current_user = explode(',', $Array);
        $data = $request->option_1."".$request->option_2."".$request->option_3."".$request->option_4;
        $string = explode(',',$data);
        dd($string);

       

        foreach ($data as $value) {
            dd($value);
        }
        $current_user = new Questions;
      
        $current_user->fill($request->all());
        $current_user->save();

        // return redirect('/question/view');
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
        return redirect('admin/question/view');

        // return view('backend.crud.index');
    }

    public function edit($question_id)
    {
        $editdata = Questions::where('question_id', $question_id)->first();
        return view('backend.crud.edit', compact('editdata'));


    }

    public function update(request $request ,$question_id)
    {
        $updatedata = Questions::where('question_id', $question_id)->first();
        $updatedata->fill($request->all());
        $updatedata->save();
        return view('backend.crud.index',compact('updatedata'));

    }


    public function delete($question_id)
    {

        $deletedata = Questions::findOrFail($question_id);
        $deletedata->delete();
        return redirect()->back();

    }




public function stepform(){

    $data = Questions::all();
    return view('backend.stepform.stepform', compact('data'));
}


if (isset($purchase_bill)) {
    // dd($purchase_bill->toArray());
    for ($i = 0; $i < count($purchase_bill); $i++) {
        $purchase_bill = Purchasebill::where('id', $purchase_bill[$i]->id)->get();
        // dd($purchase_bill->toArray());

        // $purchase_bill = $purchase_bill[$i]->id;
        $purchase_bill->each->delete();
    }
}



}

if ($request->unit[$i] == 'Gm' || $request->unit[$i] == 'Kg' && $pro_q->product_unit == 'Gm') {
    dd('ok');
    // $product_quantity = (int)$pro_q->product_stock + (int)$request->quantity[$i];
    // dd($product_quantity);
    // $pro_q->product_stock = $product_quantity;
} else {
    return redirect()->back()->with('error', 'Wrong Unit Selected');

}