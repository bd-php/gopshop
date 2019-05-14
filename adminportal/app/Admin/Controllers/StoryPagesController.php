<?php
#app/Admin/Controller/StoryPagesController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\Characters;
use App\Models\Moods;
use App\Models\Story;
use App\Models\StoryPages;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class StoryPagesController extends Controller
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

            $content->header("Story Pages");
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

            $pageinfo = StoryPages::find($id)->toArray();

            //dd($pageinfo['story_id'], $pageinfo['char_id']);
            //dd($id);

            $content->body($this->form($pageinfo['story_id'], $pageinfo['char_id'])->edit($id));
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
        return Admin::grid(StoryPages::class, function (Grid $grid) {

            $grid->actions(function ($actions) {
                //$actions->disableView();
            });

            $grid->page_id('Page ID')->sortable();
            $grid->column('story_modifier.story_name', 'Story Name')->sortable();

            $states = [
                'on' => ['value' => 'yes', 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 'no', 'text' => 'NO', 'color' => 'default'],
            ];
            $grid->validity_check('Validity Check')->switch($states);

            $grid->validity_failed_msg('Validation Msg');
            $grid->background_image('Background Image')->image('', 50);
            $grid->dialogue_text('Dialogue Text');
            $grid->dialogue_type('Dialogue Type');
            $grid->column('char_modifier.char_name', 'Character Name');
            $grid->column('mood_modifier.mood_name', 'Character Mood');
            $grid->char_alignment('Character Alignment');

//            $grid->column('Added By')->display(function () {
//                return 'blablabla....';
//            });

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

            $grid->model()->orderBy('page_id', 'desc');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($storyid = -1, $charid = -1)
    {
        $this->storyid = $storyid;
        $this->charid = $charid;

        Admin::script($this->jsProcess());
        return Admin::form(StoryPages::class, function (Form $form) {

            $form->tab(trans('Dialogue'), function ($form) {

                $urlgetCharList = route('getListCharacter');
                $urlgetMoodList = route('getListMoods');

                $list = (new Story())->getStories();
                $form->select('story_id', 'Story Name')
                    ->options($list)
                    ->load('char_id', $urlgetCharList)
                    ->rules('required');

                $states = [
                    'on' => ['value' => 'yes', 'text' => 'YES', 'color' => 'primary'],
                    'off' => ['value' => 'no', 'text' => 'NO', 'color' => 'default'],
                ];
                $form->switch('validity_check', 'Validity Check')->states($states)->default('on');

                $form->text('validity_failed_msg', 'Validity Failed Msg');
                //$form->text('dialogue_text', 'Dialogue Text')->rules('required');

                $form->image('background_image', 'Background Image');

                $form->textarea('dialogue_text', 'Dialogue Text')->rules('required');

                $list = (new StoryPages())->getDialogueTypeList();
                $form->select('dialogue_type', 'Dialogue Type')
                    ->options($list)
                    ->rules('required');


                if ($this->storyid == -1) {
                    $list = [];
                } else {
                    $list = (new Characters())->getStoryCharactersList($this->storyid);
                }
                //$list = (new Characters())->getStoryCharactersAll();
                //$form->select('char_id', 'Character Name')->options($list);
                $form->select('char_id', 'Character Name')->options($list)->load('mood_id', $urlgetMoodList);

                if ($this->charid == -1) {
                    $list = [];
                } else {
                    $list = (new Moods())->getCharacterMoodsList($this->charid);
                }
                //$list = (new Moods())->getCharMoodsAll();
                $form->select('mood_id', 'Character Mood')->options($list);

                $list = (new StoryPages())->getCharAlignmentList();
                $form->select('char_alignment', 'Character Alignment')->options($list);

                $form->number('next_page_id', 'Next Page ID');

            })->tab('Buttons', function ($form) {

                $form->hasMany('buttons', function (Form\NestedForm $form) {
                    $form->text('btn_title', 'Button Title')->rules('required');
                    $form->number('next_pageid', 'Next Page ID')->rules('required');
                });

            });

            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });
        });
    }

    public function jsProcess()
    {
        $urlgetCharList = route('getListCharacter');
        return
            <<<JS
        $(document).ready(function(){
            
            var validity_check_val = $('[name*="validity_check"]').val();
            console.log(validity_check_val);
            if(validity_check_val == 'on'){
                $('[name*="validity_failed_msg"]').closest('.form-group').show();
            } else {
                $('[name*="validity_failed_msg"]').closest('.form-group').hide();
            }
                       
        });

     

        $('[name*="validity_check"]').change(function(){
            console.log('changed');
            var validity_check_val = $('[name*="validity_check"]').val();
            console.log(validity_check_val);
            if(validity_check_val == 'on'){
                $('[name*="validity_failed_msg"]').closest('.form-group').show();
            } else {
                $('[name*="validity_failed_msg"]').closest('.form-group').hide();
            }
        });
                
        // $('[name*="dialogue_type"]').change(function(){
        //     console.log('dialogue_type changed');
        //     var dialogue_type_val = $('[name*="dialogue_type"]').val();
        //     console.log(dialogue_type_val);
        //     if(dialogue_type_val == 'description'){
        //         $('[name*="char_alignment"]').closest('.form-group').hide();
        //     } else {
        //         $('[name*="char_alignment"]').closest('.form-group').show();
        //     }
        // });


JS;
    }

    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('');
            $content->description('');
            $content->body(Admin::show(StoryPages::with('page_add_modifier', 'page_update_modifier', 'story_modifier', 'char_modifier', 'mood_modifier')->findOrFail($id), function (Show $show) {

                $show->page_id('ID');
                $show->story_modifier()->story_name('Story Name');
                $show->validity_check('Validity Check');
                $show->validity_failed_msg('Validity Failed Msg');
                $show->background_image('Cover Image')->image('', 200);
                $show->dialogue_text('Dialogue Text');
                $show->dialogue_type('Dialogue Type');
                $show->char_modifier()->char_name('Character Name');
                $show->mood_modifier()->mood_name('Character Mood');
                $show->page_add_modifier()->name('Added By');
                $show->page_added_time('Added Time');
                $show->page_update_modifier()->name('Last Updated By');
                $show->page_updated_time('Last Updated Time');
            }));
        });
    }
}
