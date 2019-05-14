<?php

Route::group(
    [
        'namespace' => 'App\Modules\Cms\Controllers',
    ], function () {
        Route::get('/cms/{name}_{id}.html', 'Content@category')->name('cmsCategory');
        Route::get('/entry/{name}_{id}.html', 'Content@content')->name('cmsContent');
    });
