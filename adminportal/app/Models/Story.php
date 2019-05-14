<?php

namespace App\Models;

use Encore\Admin\Facades\Admin;
use Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Story extends Model
{
    public $timestamps = false;
    public $table = 'gopshop_story';
    public $primaryKey = 'story_id';

    public function story_add_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'story_added_by', 'id');
    }

    public function story_update_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'story_updated_by', 'id');
    }

    public function applications_modifier()
    {
        return $this->belongsTo('App\Models\Applications', 'app_id', 'app_id');
    }

    public function category_modifier()
    {
        return $this->belongsTo('App\Models\StoryCategory', 'cat_id', 'cat_id');
    }

    public function theme_modifier()
    {
        return $this->belongsTo('App\Models\Themes', 'theme_id', 'theme_id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $id = Admin::user()->id;
            $model->story_added_by = $id;
            $model->story_added_time = $model->freshTimestamp();
        });
        static::updating(function ($model) {
            $id = Admin::user()->id;
            $model->story_updated_by = $id;
            $model->story_updated_time = $model->freshTimestamp();
        });
    }

    public function getStoryTypeList()
    {
        $list = [];
        $list['horror'] = 'Horror';
        $list['romantic'] = 'Romantic';
        return $list;
    }


    public function getStories()
    {
        $list = [];
        $result = $this->select(DB::raw('story_id, story_name'))
            ->where('story_status', 'active')
            ->get();
        foreach ($result as $value) {
            $list[$value['story_id']] = $value['story_name'];
        }
        return $list;
    }

}
