<?php

namespace NttpsApp\Http\Controllers\Backend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use NttpsApp\Model\Banner;
use NttpsApp\Models\Category;
use NttpsApp\Models\Setting;

class AppearanceController extends Controller
{
    //
    private $folder_view = 'backend.pages.appearances.';
    public function bannerIndex(Request $request)
    {
      
        $collections = Setting::whereName('widgets_collection')->first()->getSettingJson();
        $footer_column_one = Setting::whereName('footer_column_one')->first();
        $footer_column_two = Setting::whereName('footer_column_two')->first();
        $footer_column_three = Setting::whereName('footer_column_three')->first();
        $footer_column_four = Setting::whereName('footer_column_four')->first();

        $banners = Banner::where('type', 'home')->get();
        return view($this->folder_view . 'index', compact('banners', 'collections' , 'footer_column_one' ,'footer_column_two' ,'footer_column_three' , 'footer_column_four'));
    }

    public function bannerEdit($id)
    {
        $banner = Banner::find($id);
        return view($this->folder_view . '.home.edit', compact('banner'));
    }

    public function bannerStore(Request $request)
    {
        $banner = Banner::find($request->id);

        $banner->name = $request->name;
        $banner->text_button = $request->text_button;
        $banner->image = $request->image;
        $banner->text_show = ($request->has('open_description')) ? 1 : 0;
        $banner->button_show = ($request->has('open_button')) ? 1 : 0;
        $banner->links = $request->link;
        $banner->text = $request->description;
        $banner->save();
        return redirect()->back();
    }

    public function collectionUpdate(Request $request)
    {
       
        $collections = Setting::whereName('widgets_collection')->first();
        //dd($request->all());
        $images = array();     

        foreach ($request->image as $key=> $array_item) {
                $images[$key]['image'] =  $array_item;
                $images[$key]['category'] =  $request->category[$key];
        }

        $collections->value = json_encode($images);
        $collections->save();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function searchCollection(Request $request)
    {
        if ($request->ajax()) {
            $products = Category::whereTranslationLike('display_name', '%' . $request->q . '%')->get();
            $count = Category::whereTranslationLike('display_name', '%' . $request->q . '%')->count();
            return response()->json(['incomplete_results' => 'false', 'total_count' => $count,  'items' => $products], 200);
        }
    }

    public function footerUpdate(Request $request)
    {
       
        if($request->title_setting != 'footer_column_one' && $request->title_setting != 'footer_column_two') {
            $setting = Setting::whereName($request->title_setting)->first();
            //dd($request->all());

            //dd($request->word);
            $setting->options = $request->word;
            $setting->save();
            foreach (['th', 'en', 'cn'] as $locale) {
                $setting->translateOrNew($locale)->display_name = $request->{"name_" . $locale};
            }
            $setting->save();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        }
        $setting = Setting::whereName($request->title_setting)->first();
        //dd($request->all());
        foreach (['th', 'en', 'cn'] as $locale) {
            $setting->translateOrNew($locale)->display_name = $request->{"name_" . $locale};
            $setting->translateOrNew($locale)->body_html =  $request->{"body_description_" . $locale};
        }
        $setting->save();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

}
