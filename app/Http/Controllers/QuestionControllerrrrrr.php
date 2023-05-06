<?php

namespace App\Http\Controllers\backend;

use App\Models\backend\Questions;
use Illuminate\Http\Request;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;
use Symfony\Component\Console\Question\Question;

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
        $current_user = new Questions;

        $current_user->fill($request->all());
        $current_user->save();

        return redirect('/question/view');

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




}