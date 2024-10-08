<?php

namespace NttpsApp\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;

class CartController extends Controller
{
    //

    public function index()
    {
        return view('frontend.pages.cart');
    }
}
