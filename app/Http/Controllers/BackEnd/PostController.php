<?php

namespace NttpsApp\Http\Controllers\Backend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use NttpsApp\Models\PostCategory;
use NttpsApp\Models\Post;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('backend.pages.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PostCategory::with('children')->whereNull('parent_id')->get();
        $categoriesForData = collect([]); //input collect categories for create
        return view('backend.pages.posts.add-edit', compact('categories', 'categoriesForData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->slug = $request->slug;
        $post->image = $request->image;

        $data_seo[] = [
            'seo_title' => $request->seo_title,
            'seo_keywords' => $request->seo_keywords,
            'seo_description' => $request->seo_description,
        ];


        $post->seo_meta = $data_seo;
        $post->banner_header = $request->banner;
        $post->save();
        foreach (['en', 'th', 'cn'] as $locale) {
            $post->translateOrNew($locale)->display_name = $request->{"name_" . $locale};
            $post->translateOrNew($locale)->body_html =  $request->{"body_description_" . $locale};
        }

        $post->save();
        if ($request->categories) {
            foreach ($request->categories as $category) {
                $post->categories()->attach($category);
            }
        }
        return redirect()->route('admin.posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = PostCategory::with('children')->whereNull('parent_id')->get();
        $categoriesForData = $post->categories()->get();

        return view('backend.pages.posts.add-edit', compact('post', 'categories', 'categoriesForData'));
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

        $post = Post::find($id);
        $post->slug = $request->slug;
        $post->image = $request->image;

        $data_seo[] = [
            'seo_title' => $request->seo_title,
            'seo_keywords' => $request->seo_keywords,
            'seo_description' => $request->seo_description,
        ];


        $post->seo_meta = $data_seo;
        $post->banner_header = $request->banner;
        $post->save();
        foreach (['en', 'th', 'cn'] as $locale) {
            $post->translateOrNew($locale)->display_name = $request->{"name_" . $locale};
            $post->translateOrNew($locale)->body_html =  $request->{"body_description_" . $locale};
        }

        $post->save();
        if ($request->categories) {
            foreach ($request->categories as $category) {
                $post->categories()->attach($category);
            }
        }
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
        $Post = Post::find($id);
        $Post->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
