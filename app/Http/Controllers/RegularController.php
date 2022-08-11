<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegularController extends Controller
{
    public function index()
    {
        return view('regular.home');
    }

    public function profile () {
        return "reg profile";
    }
}
