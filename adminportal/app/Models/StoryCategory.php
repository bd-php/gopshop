<?php

namespace App\Models;

use Encore\Admin\Facades\Admin;
use Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StoryCategory extends Model
{
    public $timestamps = false;
    public $table = 'gopshop_category';
    public $primaryKey = 'cat_id';

    public function cat_add_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'cat_added_by', 'id');
    }

    public function cat_update_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'cat_updated_by', 'id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $id = Admin::user()->id;
            $model->cat_added_by = $id;
            $model->cat_added_time = $model->freshTimestamp();
        });
        static::updating(function ($model) {
            $id = Admin::user()->id;
            $model->cat_updated_by = $id;
            $model->cat_updated_time = $model->freshTimestamp();
        });
    }

    public function getCategories()
    {
        $list   = [];
        $result = $this->select(DB::raw('cat_id, cat_name'))
            ->where('cat_status', 'active')
            ->get();
        foreach ($result as $value) {
            $list[$value['cat_id']] = $value['cat_name'];
        }
        return $list;
    }


}
