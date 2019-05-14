<?php

namespace App\Models;

use Encore\Admin\Facades\Admin;
use Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Moods extends Model
{
    public $timestamps = false;
    public $table = 'gopshop_moods';
    public $primaryKey = 'mood_id';

    public function mood_add_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'mood_added_by', 'id');
    }

    public function mood_update_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'mood_updated_by', 'id');
    }

    public function char_modifier()
    {
        return $this->belongsTo('App\Models\Characters', 'char_id', 'char_id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $id = Admin::user()->id;
            $model->mood_added_by = $id;
            $model->mood_added_time = $model->freshTimestamp();
        });
        static::updating(function ($model) {
            $id = Admin::user()->id;
            $model->mood_updated_by = $id;
            $model->mood_updated_time = $model->freshTimestamp();
        });
    }

    public function getCharMoodsAll()
    {
        $list = [];
        $result = $this->select(DB::raw('mood_id, mood_name'))
            ->where('mood_status', 'active')
            ->get();
        foreach ($result as $value) {
            $list[$value['mood_id']] = $value['mood_name'];
        }
        return $list;
    }

    public function getCharacterMoods($charid)
    {
        $list = [];
        $result = $this->select(DB::raw('mood_id as id, mood_name as text'))
            ->where(['mood_status' => 'active', 'char_id' => $charid])
            ->get();
        foreach ($result as $value) {
            $list[] = $value;
        }
        return $list;
    }

    public function getCharacterMoodsList($charid)
    {
        $list = [];
        $result = $this->select(DB::raw('mood_id, mood_name'))
            ->where(['mood_status' => 'active', 'char_id' => $charid])
            ->get();
        foreach ($result as $value) {
            $list[$value['mood_id']] = $value['mood_name'];
        }
        return $list;
    }

}
