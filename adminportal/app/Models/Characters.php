<?php

namespace App\Models;

use Encore\Admin\Facades\Admin;
use Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Characters extends Model
{
    public $timestamps = false;
    public $table = 'gopshop_characters';
    public $primaryKey = 'char_id';

    public function char_add_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'char_added_by', 'id');
    }

    public function char_update_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'char_updated_by', 'id');
    }

    public function story_modifier()
    {
        return $this->belongsTo('App\Models\Story', 'story_id', 'story_id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $id = Admin::user()->id;
            $model->char_added_by = $id;
            $model->char_added_time = $model->freshTimestamp();
        });
        static::updating(function ($model) {
            $id = Admin::user()->id;
            $model->char_updated_by = $id;
            $model->char_updated_time = $model->freshTimestamp();
        });
    }

    public function getStoryCharactersAll()
    {
        $list = [];
        $result = $this->select(DB::raw('char_id, char_name'))
            ->where('char_status', 'active')
            ->get();
        foreach ($result as $value) {
            $list[$value['char_id']] = $value['char_name'];
        }
        return $list;
    }

    public function getStoryCharactersAllWithStoryName()
    {
        $list = [];
        $result = $this->select(DB::raw('char_id, char_name, story_name'))
            ->join('gopshop_story', 'gopshop_story.story_id', '=', 'gopshop_characters.story_id')
            ->where('char_status', 'active')
            ->get();

        foreach ($result as $value) {
            $list[$value['char_id']] = $value['char_name'] . ' [' . $value['story_name'] . ']';
        }
        return $list;
    }

    public function getStoryCharacters($storyid)
    {
        $list = [];
        $result = $this->select(DB::raw('char_id as id, char_name as text'))
            ->where(['char_status' => 'active', 'story_id' => $storyid])
            ->get();
        foreach ($result as $value) {
            $list[] = $value;
        }
        return $list;
    }

    public function getStoryCharactersList($storyid)
    {
        $list = [];
        $result = $this->select(DB::raw('char_id, char_name'))
            ->where(['char_status' => 'active', 'story_id' => $storyid])
            ->get();
        foreach ($result as $value) {
            $list[$value['char_id']] = $value['char_name'];
        }
        return $list;
    }

}
