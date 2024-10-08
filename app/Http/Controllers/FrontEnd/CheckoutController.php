<?php

namespace NttpsApp\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;

class CheckoutController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }
}
