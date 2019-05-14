<?php

namespace App\Models;

use Encore\Admin\Facades\Admin;
use Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Themes extends Model
{
    public $timestamps = false;
    public $table = 'gopshop_theme';
    public $primaryKey = 'theme_id';

    public function theme_add_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'theme_added_by', 'id');
    }

    public function theme_update_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'theme_updated_by', 'id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $id = Admin::user()->id;
            $model->theme_added_by = $id;
            $model->theme_added_time = $model->freshTimestamp();
        });
        static::updating(function ($model) {
            $id = Admin::user()->id;
            $model->theme_updated_by = $id;
            $model->theme_updated_time = $model->freshTimestamp();
        });
    }

    public function getThemes()
    {
        $list = [];
        $result = $this->select(DB::raw('theme_id, theme_name'))
            ->where('theme_status', 'active')
            ->get();
        foreach ($result as $value) {
            $list[$value['theme_id']] = $value['theme_name'];
        }
        return $list;
    }


}
