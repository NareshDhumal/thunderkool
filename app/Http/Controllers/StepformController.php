<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use Illuminate\Http\Request;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;
use Symfony\Component\Console\Question\Question;

class stepform extends Controller
{

    public function index()
    {

        $data = Questions::all();
        return view('stepform.stepform', compact('data'));
    }


}