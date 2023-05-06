<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\State;
use App\Models\backend\Supplier;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(){
        $state = State::all();
        // dd($state->toArray());
        return view('backend.state.index', compact('state'));
    }

    public function create(){

        return view('backend.state.create');
    }

    public function store(request $request){

        $this->validate($request,[
        'state_name' => 'required',
        ]);

        $state = new State();
        $state->fill($request->all());
        $state->save();

        return redirect('admin/state/');
    }

    public function edit($id){

        $editdata = State::where('state_id', $id)->first();
        return view('backend.state.edit', compact('editdata'));
        
    }

    public function update(request $request){

        $id = $request->input('state_id');
        $updatedata = State::findOrFail($id);
        $updatedata->fill($request->all());
        $updatedata->save();

        return redirect('admin/state/');
    }

    public function delete($id){

        $deletedata = State::findOrFail($id);
        $deletedata->delete();
        return redirect('admin/state/');
    }

  
}
