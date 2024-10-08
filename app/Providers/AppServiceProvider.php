<?php

namespace NttpsApp\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use View;
use NttpsApp\Models\Page;
use NttpsApp\Models\Setting; 
use NttpsApp\Models\Tag;
use NttpsApp\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            $view->with('menu_product_pages', Page::where('is_page_products', 1)->get());
            $view->with('categories', Category::withTranslation()->where('parent_id' , NULL)->get());
            $view->with('tags', Tag::all());
            $view->with('footer_column_one', Setting::whereName('footer_column_one')->first());
            $view->with('footer_column_two', Setting::whereName('footer_column_two')->first());
            $view->with('footer_column_three', Setting::whereName('footer_column_three')->first());
            $view->with('footer_column_four', Setting::whereName('footer_column_four')->first());
        });

        Blade::component('backend.components.alert', 'alert');
    }
}
