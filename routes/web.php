<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//HOME
Route::get('/', 'Frontend\PageController@home')->name('home');

//ABOUT
Route::get('/about-us', 'Frontend\PageController@aboutUs')->name('about-us');

//Collection
Route::get('/page/{slug}', 'Frontend\PageController@page')->name('page');

//CONTACT
Route::get('/contact-us', 'Frontend\PageController@contactUs')->name('contact');




//TAG
Route::get('tag/{slug}', 'Frontend\PageController@tag')->name('tag');

//Cate
Route::resource('categories', 'Frontend\CategoryController')->only([
    'index', 'show'
])->names([
    'index' => 'categories.index',
    'show'  => 'categories.view',
]);

//Product
Route::resource('products', 'Frontend\ProductController')->only([
    'index', 'show'
])->names([
    'index' => 'products.index',
    'show'  => 'products.view',
]);

//CART
Route::resource('cart', 'Frontend\CartController')->only([
    'index', 'store'
])->names([
    'index' => 'cart.index',
    'store'  => 'cart.store',
]);

//Checkout
Route::resource('checkout', 'Frontend\CheckoutController')->only([
    'index', 'store'
])->names([
    'index' => 'checkout.index',
    'store'  => 'checkout.store',
]);



//Privacy
Route::get('privacy-policy', 'Frontend\PageController@privacyPolicy')->name('privacy-policy');

//Term & Conditions
Route::get('term-conditions', 'Frontend\PageController@termConditions')->name('term-conditions');

//Work with Us
Route::get('work-with-us', 'Frontend\PageController@workWithUs')->name('work-with-us');

Auth::routes();

Route::group(['middleware' => 'auth'], function () { });
