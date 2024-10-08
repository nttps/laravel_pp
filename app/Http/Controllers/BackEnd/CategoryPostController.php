<?php

namespace NttpsApp\Http\Controllers\Backend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use NttpsApp\Models\PostCategory;
use NttpsApp\Http\Requests\Requests\CategoryPost as CategoryPostRequest;

class CategoryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PostCategory::all();
        return view('backend.pages.posts.categories.index', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryPostRequest $request)
    {
        $data =  new PostCategory;
        $data->slug = $request->slug;
        $data->image = $request->image;
        $data->parent_id = $request->parent_id;
        $data->save();
        foreach (['en', 'th', 'cn'] as $locale) {
            $data->translateOrNew($locale)->display_name = $request->name;
        }
        $data->save();
        return redirect()->route('admin.post.categories.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PostCategory::find($id);
        $categories = PostCategory::where('id', '!=', $id)->get();
        return view('backend.pages.posts.categories.edit', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryPostRequest $request, $id)
    {

        $data = PostCategory::find($id);
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
        $postCate = PostCategory::find($id);
        $postCate->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
