<?php

/*
|--------------------------------------------------------------------------
| Web Customer Route
| NTTPS : 16/04/2016
| teamerze@gmail.com
|--------------------------------------------------------------------------
|
*/

//Profile
Route::get('/' , 'MainController@index')->name('index');


Route::get('/history' , 'MainController@historyIndex')->name('history.index');
Route::get('/history/{id}' , 'MainController@historyShow')->name('history.show');
Route::get('/payment' , 'MainController@paymentIndex')->name('payment.index');
Route::get('/shipped' , 'MainController@shippedIndex')->name('shipped.index');
Route::put('/payment/{id}' , 'MainController@paymentUpload')->name('payment.update');
Route::get('/payment/{id}' , 'MainController@paymentShow')->name('payment.show');
Route::get('/profile' , 'MainController@profileIndex')->name('profile.index');
Route::post('/profile' , 'MainController@profileStore')->name('profile.store');

Route::get('/history/{id}/cancle' , 'MainController@orderCancle')->name('order.cancle');

Route::get('/address' , 'MainController@addressIndex')->name('address.index');
Route::post('/address/new' , 'MainController@addressNew')->name('address.new');
Route::put('/address/{id}/edit' , 'MainController@addressEdit')->name('address.edit');