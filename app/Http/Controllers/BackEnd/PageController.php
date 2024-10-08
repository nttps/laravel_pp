<?php

namespace NttpsApp\Http\Controllers\Backend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use Module;

class PageController extends Controller
{
    //

    public function index()
    {
        return view('backend.pages.dashboard');
    }

    public function modules()
    {
        $modules = Module::all();
        return view('backend.pages.modules', compact('modules'));
    }
}
