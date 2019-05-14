<?php

namespace App\Models;

use Encore\Admin\Facades\Admin;
use Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StoryPageButtons extends Model
{
    public $timestamps = false;
    public $table = 'gopshop_story_pages_buttons';
    public $primaryKey = 'btn_id';
    protected $fillable = ['btn_title', 'next_pageid'];

    public function btn_add_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'btn_added_by', 'id');
    }

    public function btn_update_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'btn_updated_by', 'id');
    }

    public function story_page_modifier()
    {
        return $this->belongsTo('App\Models\StoryPages', 'page_id', 'page_id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $id = Admin::user()->id;
            $model->btn_added_by = $id;
            $model->btn_added_time = $model->freshTimestamp();
        });
        static::updating(function ($model) {
            $id = Admin::user()->id;
            $model->btn_updated_by = $id;
            $model->btn_updated_time = $model->freshTimestamp();
        });
    }

}
