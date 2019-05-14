<?php

namespace App\Models;

use Encore\Admin\Facades\Admin;
use Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Applications extends Model
{
    public $timestamps = false;
    public $table = 'gopshop_applications';
    public $primaryKey = 'app_id';

    public function application_add_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'application_added_by', 'id');
    }

    public function application_update_modifier()
    {
        return $this->belongsTo('App\Models\AdminUser', 'application_updated_by', 'id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $id = Admin::user()->id;
            $model->application_added_by = $id;
            $model->application_added_time = $model->freshTimestamp();
        });
        static::updating(function ($model) {
            $id = Admin::user()->id;
            $model->application_updated_by = $id;
            $model->application_updated_time = $model->freshTimestamp();
        });
    }

    public function getApplications()
    {
        $list   = [];
        $result = $this->select(DB::raw('app_id, application_name'))
            ->where('application_status', 'active')
            ->get();
        foreach ($result as $value) {
            $list[$value['app_id']] = $value['application_name'];
        }
        return $list;
    }


}
