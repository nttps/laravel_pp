<?php

namespace NttpsApp\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use NttpsApp\Models\Product\ModelProduct;

class ProductController extends Controller
{
    public function index()
    {
        return view('frontend.pages.products.index');
    }

    public function show($slug)
    {
        $product = ModelProduct::where('slug' , $slug)->withTranslation()->firstOrFail();

        return view('frontend.pages.products.view' , compact('product' , 'images'));
    }
}
