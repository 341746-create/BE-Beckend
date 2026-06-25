<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TandartsController extends Controller
{
    public function index()
    {
        $title = 'Welkom Tandarts';
        return view('tandarts.index', compact('title'));
    }
}