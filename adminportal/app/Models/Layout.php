<?php
#app/Models/Layout.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    public $timestamps = false;
    public $table      = 'layout';
    /**
     * Get value field page_display same array
     * @param  [type] $page_display [description]
     * @return [type]                 [description]
     */
    public function getPageDisplayAttribute($page_display)
    {
        if (is_string($page_display) && $page_display) {
            return explode(',', $page_display);
        } else {
            return $page_display;
        }
    }

/**
 * Set value for field page_display
 * @param [type] $page_display [description]
 */
    public function setPageDisplayAttribute($page_display)
    {
        if (is_array($page_display)) {
            $this->attributes['page_display'] = implode(',', $page_display);
        } else {
            $this->attributes['page_display'] = $page_display;
        }

    }

    public static function getLayout()
    {
        return self::where('status', 1)
            ->orderBy('sort', 'desc')
            ->get()
            ->groupBy('position');
    }

}
