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


Route::get('login', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@postlogin')->name('postlogin');

//Route::get('/', 'MainController');

Route::middleware('admin')->group(function () {
    Route::get('/', 'PageController@index')->name('dashboard');

    Route::get('/media', 'MediaController@index')->name('media');
    Route::post('/media/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');

    //Product
    Route::resource('/products', 'ProductController');
    Route::post('/products/uploadImages', 'ProductController@uploadImages')->name('products.uploadImages');
    Route::post('/products/deleteImages', 'ProductController@deleteImages');
    Route::get('/product/relates', 'ProductController@relateSearch')->name('products.relate');
    
    Route::any('api/products', 'API\DataloadController@products')->name('api.products');


    //Order
    Route::resource('/orders', 'ProductController')->except([
        'show'
    ]);

    Route::any('api/orders', 'API\DataloadController@orders')->name('api.orders');

    //Category Product
    Route::resource('/product/categories', 'CategoryProductController')->except([
        'show', 'create'
    ])->names([
        'index' => 'product.categories.index',
        'store' => 'product.categories.store',
        'edit'  => 'product.categories.edit',
        'update'  => 'product.categories.update',
        'destroy'  => 'product.categories.destroy',
    ]);
    Route::any('api/product/categories', 'API\DataloadController@productcategories')->name('api.productcategories');
    

    //Attribute Product
    Route::resource('/product/attributes', 'AttributeController')->except([
        'show', 'create'
    ])->names([
        'index' => 'product.attributes.index',
        'store' => 'product.attributes.store',
        'edit'  => 'product.attributes.edit',
        'update'  => 'product.attributes.update',
        'destroy'  => 'product.attributes.destroy',
    ]);
    Route::any('api/product/attributes', 'API\DataloadController@productattributes')->name('api.productattributes');
    Route::put('product/attributes_value/add/{id}', 'AttributeController@updateValueAttribute')->name('ajax.update.value');
    Route::put('product/attributes_value/{id}', 'AttributeController@editValueAttribute')->name('ajax.edit.value');
    Route::delete('product/attributes_value/{id}', 'AttributeController@deleteValueAttribute')->name('ajax.del.value');
    
    
    //Tags Product
    Route::resource('/product/tags', 'TagProductController')->except([
        'show', 'create'
    ])->names([
        'index' => 'product.tags.index',
        'store' => 'product.tags.store',
        'edit'  => 'product.tags.edit',
        'update'  => 'product.tags.update',
        'destroy'  => 'product.tags.destroy',
    ]);
    Route::any('api/product/tags', 'API\DataloadController@producttags')->name('api.product.tags');

    //Role
    Route::resource('/roles', 'RoleController');

    //User
    Route::resource('/users', 'UserController');

    //Post
    Route::resource('/posts', 'PostController');
    Route::any('api/posts', 'API\DataloadController@posts')->name('api.posts');


    //Category Post
    Route::resource('/post/categories', 'CategoryPostController')->except([
        'show', 'create'
    ])->names([
        'index' => 'post.categories.index',
        'store' => 'post.categories.store',
        'edit'  => 'post.categories.edit',
        'update'  => 'post.categories.update',
        'destroy'  => 'post.categories.destroy',
    ]);
    Route::any('api/postcategories', 'API\DataloadController@postcategories')->name('api.postcategories');

    //Page
    Route::resource('/pages', 'PageSiteController');
    Route::any('api/pages', 'API\DataloadController@pages')->name('api.pages');


    //appearance
    Route::prefix('appearance')->name('appearance.')->group(function () {
        Route::get('/', 'AppearanceController@bannerIndex')->name('banner.index');
        Route::get('banner/edit/{id}', 'AppearanceController@bannerEdit')->name('banner.edit');
        Route::post('banner', 'AppearanceController@bannerStore')->name('banner.store');
        Route::post('collection', 'AppearanceController@collectionUpdate')->name('collection.store');
        Route::post('collection/search', 'AppearanceController@searchCollection')->name('collection.search');

        Route::post('footer', 'AppearanceController@footerUpdate')->name('footer.store');

        
        
        
    });



    Route::name('systems.')->group(function () {
        Route::get('/modules', 'PageController@modules')->name('modules');
        Route::get('/settings/general', 'SettingController@general')->name('general.index');
        Route::post('/settings/general', 'SettingController@generalPost')->name('general.store');
    });

    Route::name('shop.')->group(function () {
        Route::prefix('setting')->name('setting.')->group(function () {
            Route::get('/' , 'SettingController@shopIndex')->name('index');
            Route::post('/' , 'SettingController@shopPost')->name('store');
            Route::get('/shipping/zone/{id}' , 'SettingController@shippingIndex')->name('shipping.index');
            Route::put('/shipping/zone/{id}' , 'SettingController@shippingEdit')->name('shipping.edit');
            Route::post('/shipping/zone/delete' , 'SettingController@shippingDelete')->name('shipping.delete');
            Route::put('/shipping/rules/{id}' , 'SettingController@shippingRuleEdit')->name('shipping.rules.edit');
            
        });
    });




    //Ajax Load System
    Route::post('/ajax_data' , 'API\AjaxDataController@index')->name('ajax_system');
});
