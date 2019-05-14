<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('homeAdmin');
    $router->resource('banner', BannerController::class)->names('bannerControl');
    $router->resource('layout', LayoutController::class)->names('layoutControl');
    $router->resource('language', LanguageController::class)->names('languageControl');
    $router->resource('currencies', CurrencyController::class)->names('currencyControl');
    $router->resource('subscribe', EmailSubscribeController::class)->names('subscribeControl');
//Config
    $router->resource('config_info', ConfigInfoController::class)->names('configInfoControl');
    $router->resource('config_global', ConfigGlobalController::class)->names('configGlobalControl');
    $router->get('config_template', 'TemplateController@index');
    $router->post('config_template', 'TemplateController@changeTemplate')->name('changeTemplate');
    $router->get('backup_database', 'BackupController@index');
    $router->post('backup_database', 'BackupController@processBackupFile')->name('processBackupFile');
    $router->post('backup', 'BackupController@generateBackup')->name('generateBackup');
    $router->any('/config_updateConfigField', 'ConfigInfoController@updateConfigField')
        ->name('updateConfigField');
    $router->get('/ckfinder', function () {
        return view('admin.ckfinder');
    });

//Story
    $router->resource('shop_customer', ShopCustomerController::class)->names('customerControl');

    $router->resource('application_list', ApplicationsController::class)->names('applicationsControl');
    $router->resource('story_category', CategoryController::class)->names('storyCategoryControl');
    $router->resource('story_list', StoryController::class)->names('storyControl');
    $router->resource('story_character', CharactersController::class)->names('characterControl');
    $router->resource('story_character_mood', MoodsController::class)->names('moodControl');
    $router->resource('story_pages', StoryPagesController::class)->names('storyPageControl');
    $router->resource('story_theme', ThemesController::class)->names('storyThemeControl');


//Get info
    $router->group(['prefix' => 'get_info'], function ($router) {

        $router->get('charList', 'CharactersController@getCharList')->name('getListCharacter');
        $router->get('moodList', 'MoodsController@getMoodList')->name('getListMoods');
    });

//Modules
    $router->group(['prefix' => 'modules'], function ($router) {
        $router->get('/{modulesGroup}', 'ModulesController@index')->name('modulesGroup');
        $router->post('/installModule', 'ModulesController@installModule')->name('installModule');
        $router->post('/uninstallModule', 'ModulesController@uninstallModule')->name('uninstallModule');
        $router->post('/enableModule', 'ModulesController@enableModule')->name('enableModule');
        $router->post('/disableModule', 'ModulesController@disableModule')->name('disableModule');
        $router->match(['put', 'post'], '/processModule/{moduleGroup}/{module}', 'ModulesController@processModule')->name('processModule');
    });
    $router->group(['prefix' => 'modules', 'namespace' => 'Modules'], function ($router) {
//        $router->resource('cms/cms_category', Cms\CmsCategoryController::class)->names('cmsCategoryControl');
//        $router->resource('cms/cms_content', Cms\CmsContentController::class)->names('cmsContentControl');
//        $router->resource('cms/cms_news', Cms\CmsNewsController::class)->names('cmsNewsControl');
        $router->resource('api/shop_api', Api\ShopApiController::class)->names('apiControl');
    });
//End module

//Extensions
    $router->group(['prefix' => 'extensions'], function ($router) {
        $router->get('/{extensionGroup}', 'ExtensionsController@index')->name('extensionGroup');
        $router->post('/installExtension', 'ExtensionsController@installExtension')->name('installExtension');
        $router->post('/uninstallExtension', 'ExtensionsController@uninstallExtension')->name('uninstallExtension');
        $router->post('/enableExtension', 'ExtensionsController@enableExtension')->name('enableExtension');
        $router->post('/disableExtension', 'ExtensionsController@disableExtension')->name('disableExtension');
        $router->match(['put', 'post'], '/processExtension/{extensionGroup}/{extension}', 'ExtensionsController@processExtension')->name('processExtension');
    });
    $router->resource('shop_discount', Extensions\Total\DiscountController::class)->names('discountControl');
//end extensions

//Language
    $router->post('locale/{code}', function ($code) {
        \App\Models\ConfigGlobal::first()->update(['locale' => $code]);
        return back();
    });
//

//Process Simpe
    $router->prefix('process')->group(function ($router) {
        $router->any('/storyImport', 'ProcessController@importStory')->name('storyImport');
    });
    $router->get('/report/{key}', 'ReportController@index')->name('report');
});
