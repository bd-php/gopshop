<?php
#app/Admin/Controller/MoodsController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Characters;
use App\Models\Moods;
use App\Models\Story;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class MoodsController extends Controller
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

            $content->header("Moods");
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

            $charinfo = Moods::with('char_modifier')->findOrFail($id)->toArray();
            //dd($charinfo);

            $content->body($this->form($charinfo['char_modifier']['story_id'])->edit($id));
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
        return Admin::grid(Moods::class, function (Grid $grid) {

            $grid->actions(function ($actions) {
                //$actions->disableView();
            });

            $grid->mood_id('ID')->sortable();

            $grid->char_id('Story Name')->display(function ($charid) {
                $storyinfo = Characters::with('story_modifier')->find($charid)->toArray();
                return $storyinfo['story_modifier']['story_name'];
            })->sortable();

            $grid->column('char_modifier.char_name', 'Character Name')->sortable();
            $grid->mood_name('Name')->sortable();
            $grid->mood_image('Image')->image('', 50);
            //$grid->type_added_by('Added By');

//            $grid->column('location_add_modifier.name', 'Added By');
//            $grid->location_add_time('Added Time');
//            $grid->column('location_update_modifier.name', 'Last Updated By');
//            $grid->location_updated_time('Last Updated Time');

            $states = [
                'on' => ['value' => 'active', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 'inactive', 'text' => 'NO', 'color' => 'default'],
            ];
            $grid->mood_status('Status')->switch($states);

            $grid->filter(function ($filter) {
                // Remove the default id filter
                $filter->disableIdFilter();

                $list = (new Characters())->getStoryCharactersAllWithStoryName();
                $filter->equal('char_id', 'Character Name')->select($list);

            });

            $grid->disableRowSelector();
            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
            });

            $grid->model()->orderBy('mood_id', 'desc');
        });
    }

    /**
     * Make a form builder.
     *
     * @param int $storyid
     * @return Form
     */
    protected function form($storyid = -1)
    {
        $this->storyid = $storyid;

        return Admin::form(Moods::class, function (Form $form) {

            $urlgetCharList = route('getListCharacter');

            $list = (new Story())->getStories();
            //$arrDist = (new Story())->getStories();
            $form->select('story_id', 'Story Name')
                ->options($list)
                ->default($this->storyid)
                ->load('char_id', $urlgetCharList)
                ->rules('required');

            if ($this->storyid == -1) {
                $list = [];
            } else {
                $list = (new Characters())->getStoryCharactersList($this->storyid);
            }
            $form->select('char_id', 'Char Name')
                ->options($list)
                ->rules('required');

            $form->text('mood_name', 'Name')->rules('required');
            $form->image('mood_image', 'Image')->rules('required');

            $states = [
                'on' => ['value' => 'active', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 'inactive', 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch('mood_status', 'Status')->states($states)->default('on');

            $form->ignore(['story_id']);

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
            $content->body(Admin::show(Moods::with('mood_add_modifier', 'mood_update_modifier', 'char_modifier')->findOrFail($id), function (Show $show) {

                $show->mood_id('ID');
                $show->char_modifier()->char_name('Character');
                $show->mood_name('Name');
                $show->mood_image('Image')->image('', 200);
                $show->mood_add_modifier()->name('Added By');
                $show->mood_added_time('Added Time');
                $show->mood_update_modifier()->name('Last Updated By');
                $show->mood_updated_time('Last Updated Time');
            }));
        });
    }

    /**
     * [getMoodList description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getMoodList(Request $request)
    {
        $char_id = $request->input('q');

        $charlist = (new Moods())->getCharacterMoods($char_id);

        return $charlist;
    }
}
