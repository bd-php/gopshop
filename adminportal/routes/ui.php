<?php
/**
 * Created by PhpStorm.
 * User: Nazibul
 * Date: 5/20/2019
 * Time: 9:54 PM
 */

Route::get('/demo', function () {
    return ["a" => "b"];
});

Route::post('/demo', function () {
    return "Hello demo";
});

Route::post('/index', 'ClientUiController@index');
Route::post('/category', 'ClientUiController@category');
Route::post('/favourite', 'ClientUiController@favourite');
Route::post('/profile', 'ClientUiController@profile');
Route::post('/notification', 'ClientUiController@notification');