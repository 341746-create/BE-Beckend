<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MondhygienistController extends Controller
{
    public function index()
    {
        return view('mondhygienist.index');
    }
}
