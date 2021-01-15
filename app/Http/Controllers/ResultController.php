<?php

namespace App\Http\Controllers;

use App\Models\Result;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::with('user', 'quiz')->get();
        return view('result/user_results')->with('results', $results);
    }

}
