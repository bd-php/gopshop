<?php
#app/Admin/Controller/StoryController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\Story;
use App\Models\StoryCategory;
use App\Models\Themes;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class StoryController extends Controller
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

            $content->header("Story");
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
        return Admin::grid(Story::class, function (Grid $grid) {

            $grid->actions(function ($actions) {
                //$actions->disableView();
            });

            $grid->story_id('Story ID')->sortable();
            $grid->column('applications_modifier.application_name', 'Application Name')->sortable();
            $grid->column('category_modifier.cat_name', 'Category')->sortable();
            $grid->column('theme_modifier.theme_name', 'Theme')->sortable();
            $grid->story_name('Name')->sortable();
            $grid->story_summary('Summary');
            $grid->story_cover_image('Cover Image')->image('', 50);

            $states = [
                'on' => ['value' => '1', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => '0', 'text' => 'NO', 'color' => 'default'],
            ];
            $grid->is_banner('Banner')->switch($states)->sortable();

            $states = [
                'on' => ['value' => '1', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => '0', 'text' => 'NO', 'color' => 'default'],
            ];
            $grid->is_feature('Feature')->switch($states)->sortable();

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
            $grid->story_status('Status')->switch($states);

            $grid->filter(function ($filter) {
                // Remove the default id filter
                $filter->disableIdFilter();

                $filter->like('story_name', 'Story Name');

            });

            $grid->disableRowSelector();
            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
            });

            $grid->model()->orderBy('story_id', 'desc');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Story::class, function (Form $form) {

            $arrDist = (new Applications())->getApplications();
            $form->select('app_id', 'Application')->options($arrDist)->rules('required');

            $typelist = (new StoryCategory())->getCategories();
            $form->select('cat_id', 'Category')->options($typelist)->rules('required');

            $themelist = (new Themes())->getThemes();
            $form->select('theme_id', 'Theme')->options($themelist)->rules('required');

            $form->text('story_name', 'Name')->rules('required');
            $form->text('story_summary', 'Summary')->rules('required');

            $form->image('story_cover_image', 'Cover Image')->rules('required');

            $states = [
                'on' => ['value' => '1', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => '0', 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch('is_banner', 'Banner')->states($states)->default('off');

            $states = [
                'on' => ['value' => '1', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => '0', 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch('is_feature', 'Feature')->states($states)->default('off');

            $states = [
                'on' => ['value' => 'active', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 'inactive', 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch('story_status', 'Status')->states($states)->default('on');

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
            $content->body(Admin::show(Story::with('story_add_modifier', 'story_update_modifier', 'applications_modifier', 'category_modifier')->findOrFail($id), function (Show $show) {

                $show->story_id('ID');
                $show->applications_modifier()->application_name('Application');
                $show->category_modifier()->cat_name('Category');
                $show->theme_modifier()->theme_name('Theme');
                $show->story_name('Name');
                $show->story_summary('Summary');
                $show->story_cover_image('Cover Image')->image('', 200);
                $show->is_banner('Banner');
                $show->is_feature('Feature');
                $show->story_add_modifier()->name('Added By');
                $show->story_added_time('Added Time');
                $show->story_update_modifier()->name('Last Updated By');
                $show->story_updated_time('Last Updated Time');
            }));
        });
    }
}
