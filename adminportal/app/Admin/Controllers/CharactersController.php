<?php
#app/Admin/Controller/CharactersController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Characters;
use App\Models\Story;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class CharactersController extends Controller
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

            $content->header("Characters");
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
        return Admin::grid(Characters::class, function (Grid $grid) {

            $grid->actions(function ($actions) {
                //$actions->disableView();
            });

            $grid->char_id('ID')->sortable();
            $grid->column('story_modifier.story_name', 'Story Name')->sortable();
            $grid->char_name('Name')->sortable();
            $grid->char_image('Image')->image('', 50);
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
            $grid->char_status('Status')->switch($states);

            $grid->filter(function ($filter) {
                // Remove the default id filter
                $filter->disableIdFilter();

                $list = (new Story())->getStories();
                $filter->equal('story_id', 'Story Name')->select($list);

            });


            $grid->disableRowSelector();
            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
            });

            $grid->model()->orderBy('char_id', 'desc');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Characters::class, function (Form $form) {

            $arrDist = (new Story())->getStories();
            $form->select('story_id', 'Story Name')->options($arrDist)->rules('required');

            $form->text('char_name', 'Name')->rules('required');
            $form->image('char_image', 'Image')->rules('required');

            $states = [
                'on' => ['value' => 'active', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 'inactive', 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch('char_status', 'Status')->states($states)->default('on');

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
            $content->body(Admin::show(Characters::with('char_add_modifier', 'char_update_modifier', 'story_modifier')->findOrFail($id), function (Show $show) {

                $show->char_id('ID');
                $show->story_modifier()->story_name('Story');
                $show->char_name('Name');
                $show->char_image('Image')->image('', 200);
                $show->char_add_modifier()->name('Added By');
                $show->char_added_time('Added Time');
                $show->char_update_modifier()->name('Last Updated By');
                $show->char_updated_time('Last Updated Time');
            }));
        });
    }

    /**
     * [getCharList description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getCharList(Request $request)
    {
        $story_id = $request->input('q');

        $charlist = (new Characters())->getStoryCharacters($story_id);

        return $charlist;
    }
}
