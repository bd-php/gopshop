<?php

namespace App\Models;

use Encore\Admin\Facades\Admin;
use Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StoryPages extends Model
{
    public $timestamps = false;
    public $table = 'gopshop_story_pages';
    public $primaryKey = 'page_id';

    public function page_add_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'page_added_by', 'id');
    }

    public function page_update_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'page_updated_by', 'id');
    }

    public function story_modifier()
    {
        return $this->belongsTo('App\Models\Story', 'story_id', 'story_id');
    }

    public function char_modifier()
    {
        return $this->belongsTo('App\Models\Characters', 'char_id', 'char_id');
    }

    public function mood_modifier()
    {
        return $this->belongsTo('App\Models\Moods', 'mood_id', 'mood_id');
    }

    public function buttons()
    {
        return $this->hasMany('App\Models\StoryPageButtons', 'page_id', 'page_id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $id = Admin::user()->id;
            $model->page_added_by = $id;
            $model->page_added_time = $model->freshTimestamp();
        });
        static::updating(function ($model) {
            $id = Admin::user()->id;
            $model->page_updated_by = $id;
            $model->page_updated_time = $model->freshTimestamp();
        });
    }

    public function getDialogueTypeList()
    {
        $list = [];
        $list['conversation'] = 'Conversation';
        $list['thinking'] = 'Thinking';
        $list['description'] = 'Description';
        return $list;
    }

    public function getCharAlignmentList()
    {
        $list = [];
        $list['left'] = 'Left';
        $list['middle'] = 'Middle';
        $list['right'] = 'Right';
        return $list;
    }

}
