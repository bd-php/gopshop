<?php
#app/Admin/Controllers/ApplicationsController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\Themes;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ThemesController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header("Themes");
            $content->description(' ');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header(trans('Edit'));
            $content->description(' ');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header(trans('Add'));
            $content->description(' ');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Themes::class, function (Grid $grid) {

            $grid->actions(function ($actions) {
                //$actions->disableView();
            });

            $grid->theme_id('Theme ID')->sortable();
            $grid->theme_name('Theme Name')->sortable();
            $grid->column('theme_add_modifier.name', 'Added By')->sortable();
            //$grid->type_added_by('Added By');

//            $grid->column('Added By')->display(function () {
//                return 'blablabla....';
//            });

//            $grid->column('location_add_modifier.name', 'Added By');
//            $grid->location_add_time('Added Time');
//            $grid->column('location_update_modifier.name', 'Last Updated By');
//            $grid->location_updated_time('Last Updated Time');

            $states = [
                'on' => ['value' => 'active', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 'inactive', 'text' => 'NO', 'color' => 'default'],
            ];
            $grid->theme_status('Status')->switch($states);

            $grid->disableFilter();
            $grid->disableRowSelector();
            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
            });

            $grid->model()->orderBy('theme_id', 'desc');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Themes::class, function (Form $form) {

            $form->text('theme_name', 'Theme Name')->rules('required');

            $states = [
                'on' => ['value' => 'active', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 'inactive', 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch('theme_status', "Status")->states($states)->default('on');

            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });
        });
    }

    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('');
            $content->description('');
            $content->body(Admin::show(Themes::with('theme_add_modifier', 'theme_update_modifier')->findOrFail($id), function (Show $show) {

                $show->theme_id('Theme ID');
                $show->theme_name('Theme Name');
                $show->theme_add_modifier()->name('Added By');
                $show->theme_added_time('Added Time');
                $show->theme_update_modifier()->name('Last Updated By');
                $show->theme_updated_time('Last Updated Time');
            }));
        });
    }
}
