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
Auth::routes();
//============================

//--Auth
Route::group(['namespace' => 'Auth', 'prefix' => 'member'], function ($router) {
    $router->get('/login.html', 'LoginController@showLoginForm')->name('login');
    $router->post('/login.html', 'LoginController@login')->name('postLogin');
    $router->get('/register.html', 'LoginController@showLoginForm')->name('register');
    $router->post('/register.html', 'RegisterController@register')->name('postRegister');
    $router->redirect('/login', '/login.html', 301);
    $router->post('/logout', 'LoginController@logout')->name('logout');
    $router->post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $router->post('/password/reset', 'ResetPasswordController@reset');
    $router->get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    $router->get('/forgot.html', 'ForgotPasswordController@showLinkRequestForm')->name('forgot');
});
//End Auth

//Language
Route::get('locale/{code}', function ($code) {
    $strQuery  = explode('?', url()->previous());
    $arrParams = [];
    if (!empty($strQuery[1])) {
        parse_str($strQuery[1], $arrParams);
        unset($arrParams['lang']);
    }
    if ($arrParams) {
        $url = $strQuery[0] . '?' . http_build_query($arrParams);
    } else {
        $url = $strQuery[0];
    }
    session(['locale' => $code]);
    return redirect($url);
});

//Currency
Route::get('currency/{code}', function ($code) {
    session(['currency' => $code]);
    return back();
});

