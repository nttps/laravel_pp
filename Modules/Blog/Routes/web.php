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


//Product
Route::resource('/blog', 'BlogController')->only([
    'index', 'show'
])->names([
    'index' => 'blog.index',
    'show'  => 'blog.show',
]);
