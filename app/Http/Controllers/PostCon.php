<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostCon extends Controller
{
    public function index(){
        return view('addpost.post');
    }
}
