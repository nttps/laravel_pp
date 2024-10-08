<?php

namespace NttpsApp\Http\Controllers\Backend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use NttpsApp\Models\Page;
use function GuzzleHttp\json_decode;

class PageSiteController extends Controller
{

    private $folder_view = 'backend.pages.pages.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->folder_view . 'index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        return view($this->folder_view . 'add-edit', compact('page'));
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
        //dd($request);

        $page = Page::find($id);

        $data_seo[] = [
            'seo_title' => $request->seo_title,
            'seo_keywords' => $request->seo_keywords,
            'seo_description' => $request->seo_description,
        ];

        $page->seo_meta = $data_seo;
        $page->cover_header = $request->cover;
        $page->banner_header = $request->banner;


        if ($page->is_page_products == 1) {
            $page->translateOrNew('th')->display_name = $request->name_th;
            $page->translateOrNew('en')->display_name = $request->name_en;
            $page->translateOrNew('cn')->display_name = $request->name_cn;
        }
        $page->translateOrNew('th')->body_html = $request->body_description_th;
        $page->translateOrNew('en')->body_html = $request->body_description_en;
        $page->translateOrNew('cn')->body_html = $request->body_description_cn;

        $page->save();


        return redirect()->back();
    }
}
