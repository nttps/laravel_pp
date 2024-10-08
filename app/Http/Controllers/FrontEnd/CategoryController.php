<?php

namespace NttpsApp\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use NttpsApp\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $slug = explode('/', $slug);
        $category  = Category::where('slug' , end($slug))->withTranslation()->firstOrFail();
        return view('frontend.pages.categories.view', compact('category'));
    }
}
