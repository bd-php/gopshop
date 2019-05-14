<?php
#app/Admin/Controller/CharactersController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Characters;
use App\Models\Story;
use App\Models\StoryCategory;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

            $content->header("Category");
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

            $content->header("Edit");
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

            $content->header("Add");
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
        return Admin::grid(StoryCategory::class, function (Grid $grid) {

            $grid->actions(function ($actions) {
                //$actions->disableView();
            });

            $grid->cat_id('ID')->sortable();
            $grid->cat_name('Name')->sortable();
            $grid->cat_image('Image')->image('', 50);

//            $grid->column('Added By')->display(function () {
//                return 'blablabla....';
//            });

            $states = [
                'on' => ['value' => 'active', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 'inactive', 'text' => 'NO', 'color' => 'default'],
            ];
            $grid->cat_status('Status')->switch($states);

            $grid->disableFilter();
            $grid->disableRowSelector();
            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
            });

            $grid->model()->orderBy('cat_id', 'desc');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(StoryCategory::class, function (Form $form) {

            $form->text('cat_name', 'Name')->rules('required');
            $form->image('cat_image', 'Image')->rules('required');

            $states = [
                'on' => ['value' => 'active', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 'inactive', 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch('cat_status', 'Status')->states($states)->default('on');

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
            $content->body(Admin::show(StoryCategory::with('cat_add_modifier', 'cat_update_modifier')->findOrFail($id), function (Show $show) {

                $show->cat_id('ID');
                $show->cat_name('Name');
                $show->cat_image('Image')->image('', 200);
                $show->cat_add_modifier()->name('Added By');
                $show->cat_added_time('Added Time');
                $show->cat_update_modifier()->name('Last Updated By');
                $show->cat_updated_time('Last Updated Time');
            }));
        });
    }

}
