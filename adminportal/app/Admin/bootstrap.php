<?php
/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
use App\Admin\Extensions\Column\Expands;
use App\Admin\Extensions\Form\CKEditor;
use App\Models\ConfigGlobal;
use App\Models\Language;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid\Column;

//Set language
$configs_global = ConfigGlobal::first();
$languages      = Language::where('status', 1)->get()->keyBy('code');
$requestLocale  = $request->get('lang');
if ($requestLocale) {
    $detectLocale = $requestLocale;
} else
if (!Session::has('locale')) {
    $detectLocale = empty($configs_global['locale']) ? config('app.locale') : $configs_global['locale'];
} else {
    $detectLocale = session('locale');
}
$currentLocale = array_key_exists($detectLocale, $languages->toArray()) ? $detectLocale : $languages->first()->code;
session(['locale' => $currentLocale, 'locale_id' => $languages[$currentLocale]['id']]);
app()->setLocale($currentLocale);
//End language
Encore\Admin\Form::forget(['map', 'editor']);
//custome template admin
app('view')->prependNamespace('admin', resource_path('views/admin'));
Column::extend('expand', Expands::class);

Form::extend('ckeditor', CKEditor::class);
//end Ckeditor
Admin::navbar(function (\Encore\Admin\Widgets\Navbar $navbar) use ($languages) {
    $configs_global = ConfigGlobal::first();
    $path_file      = config('filesystems.disks.path_file');
    $htmlLang       = '<div style="margin:10px;" class="btn-group"><button type="button" class="dropdown-toggle usa" data-toggle="dropdown"><img src="/' . $path_file . '/' . $languages[app()->getLocale()]['icon'] . '" style="height: 25px;"><span class="caret"></span></button><ul class="dropdown-menu">';
    foreach ($languages as $key => $language) {
        $htmlLang .= '<li><a href="' . url('locale/' . $key) . '"><img src="/' . $path_file . '/' . $language['icon'] . '" style="height: 25px;"></a></li>';
    }
    $htmlLang .= '</ul></div>';
    if (count($languages) > 1) {
        $navbar->left($htmlLang);
    }
    if (!empty(Admin::user()->username) && Admin::user()->username == 'test') {
        $navbar->left(trans('language.admin.note_test'));
    }
    $navbar->left(view('admin.search-bar'));

    $navbar->right('
<!--      <li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      <i class="fa fa-bell-o"></i>
      <span class="label label-warning">10</span>
    </a>
    <ul class="dropdown-menu">
      <li class="header">You have 10 notifications</li>
      <li>
        <ul class="menu">
          <li>
            <a href="#">
              <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
              page and may cause design problems
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-users text-red"></i> 5 new members joined
            </a>
          </li>

      <li>
            <a href="#">
              <i class="fa fa-shopping-cart text-green"></i> 25 sales made
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-user text-red"></i> You changed your username
            </a>
          </li>
        </ul>
      </li>
      <li class="footer"><a href="#">View all</a></li>
    </ul>
    </li>
-->

    ');

});
