<?php

namespace NttpsApp\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use NttpsApp\Model\Banner;
use NttpsApp\Models\Page;
use NttpsApp\Models\Post;
use NttpsApp\Models\Product\ModelProduct;
use NttpsApp\Models\Setting;
use NttpsApp\Models\Tag;

class PageController extends Controller
{
    //

    private $folder = 'frontend.pages';

    public function home()
    {
        $banners = Banner::where('type', 'home')->get();
        $posts = Post::all();
        $products = ModelProduct::withTranslation()->where('type' ,'!=','variable')->get();
        $collections = Setting::whereName('widgets_collection')->first()->getSettingJson();
        
        return view($this->folder . '.index', compact('banners', 'posts' , 'products' ,'collections'));
    }

    public function aboutUs()
    {
        $about = Page::where('name', 'about-us')->firstOrFail();
        return view($this->folder . '.about', compact('about'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->where('is_page_products' , 1)->firstOrFail();
        return view($this->folder . '.collection', compact('page'));
    }

    public function contactUs()
    {

        $contact = Page::where('name', 'contact')->firstOrFail();
        return view($this->folder . '.contact', compact('contact'));
    }

    public function tag($slug)
    {  
        $tag  = Tag::where('slug' , $slug)->firstOrFail();
       
        return view($this->folder . '.tag', compact('tag'));
    }

    public function privacyPolicy()
    {
        $privacy = Page::where('name', 'privacy-policy')->firstOrFail();
        return view($this->folder . '.privacy-policy' , compact('privacy'));
    }

    public function termConditions()
    {

        $term = Page::where('name', 'term-conditions')->firstOrFail();
        return view($this->folder . '.term-conditions' , compact('term'));
    }

    public function workWithUs()
    {

        $work = Page::where('name', 'work-with-us')->firstOrFail();
        return view($this->folder . '.work-with-us' , compact('work'));
    }
    
}
