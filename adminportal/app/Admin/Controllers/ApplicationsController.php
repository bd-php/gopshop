<?php
#app/Admin/Controllers/ApplicationsController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ApplicationsController extends Controller
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

            $content->header("Applications");
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
        return Admin::grid(Applications::class, function (Grid $grid) {

            $grid->actions(function ($actions) {
                //$actions->disableView();
            });

            $grid->app_id('App ID')->sortable();
            $grid->application_id('Application ID')->sortable();
            $grid->application_name('Application Name')->sortable();
            $grid->application_description('Application Description');
            $grid->column('application_add_modifier.name', 'Added By')->sortable();
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
            $grid->application_status('Status')->switch($states);

            $grid->disableFilter();
            $grid->disableRowSelector();
            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
            });

            $grid->model()->orderBy('app_id', 'desc');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Applications::class, function (Form $form) {

            $form->text('application_id', 'Application ID')->rules('required');
            $form->text('application_name', 'Application Name')->rules('required');
            $form->textarea('application_description', 'Application Description');

            $states = [
                'on' => ['value' => 'active', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 'inactive', 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch('application_status', "Status")->states($states)->default('on');

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
            $content->body(Admin::show(Applications::with('application_add_modifier', 'application_update_modifier')->findOrFail($id), function (Show $show) {

                $show->application_id('Application ID');
                $show->application_name('Application Name');
                $show->application_description('Application Description');
                $show->application_add_modifier()->name('Added By');
                $show->application_added_time('Added Time');
                $show->application_update_modifier()->name('Last Updated By');
                $show->application_updated_time('Last Updated Time');
            }));
        });
    }
}
