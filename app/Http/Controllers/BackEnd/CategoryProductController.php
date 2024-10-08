<?php

namespace NttpsApp\Http\Controllers\Backend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use NttpsApp\Models\Category;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.pages.products.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =  new Category;
        $data->slug = $request->slug;
        $data->image = $request->image;
        $data->parent_id = $request->parent_id;
        $data_seo[] = [
            'seo_title' => $request->seo_title,
            'seo_keywords' => $request->seo_keywords,
            'seo_description' => $request->seo_description,
        ];


        $data->seo_meta = $data_seo;
        $data->banner_header = collect([]);
        $data->save();
        foreach (['en', 'th', 'cn'] as $locale) {
            $data->translateOrNew($locale)->display_name = $request->name;
        }
        $data->save();
        return redirect()->route('admin.product.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::find($id);
        $categories = Category::where('id', '!=', $id)->get();
        return view('backend.pages.products.categories.edit', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Category::find($id);
        $data->parent_id = $request->parent_id;
        $data->slug = $request->slug;
        $data->image = $request->image;

        $data_seo[] = [
            'seo_title' => $request->seo_title,
            'seo_keywords' => $request->seo_keywords,
            'seo_description' => $request->seo_description,
        ];


        $data->seo_meta = $data_seo;
        $data->banner_header = $request->banner;
        $data->save();
        foreach (['en', 'th', 'cn'] as $locale) {
            $data->translateOrNew($locale)->display_name = $request->{"name_" . $locale};
            $data->translateOrNew($locale)->body_html =  $request->{"body_description_" . $locale};
        }
        $data->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postCate = Category::find($id);
        $postCate->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
