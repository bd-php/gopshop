<?php
#app/Modules/Api/Product.php
namespace App\Modules\Api;

use App\Models\Story;
use App\Models\StoryCategory;
use Illuminate\Http\Request;

class StoryApi extends \App\Http\Controllers\Controller
{
    public $apiName;
    public $data;

    public function __construct(Request $request)
    {
        $ipClient = $request->ip();
        $method = $request->method();
        $this->data = $request->all();
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        if ($this->apiName == 'story_cat_list') {
            return $this->story_cat_list($this->data);
        }
        if ($this->apiName == 'story_list_by_cat') {
            return $this->story_list_by_cat($this->data);
        }
        if ($this->apiName == 'story_banner_list') {
            return $this->story_banner_list($this->data);
        }
        if ($this->apiName == 'story_popular_list') {
            return $this->story_popular_list($this->data);
        }
    }

    /**
     * Story Category list
     * @$params array   $params input parameters
     * @return  string  json format category list
     */
    function story_cat_list()
    {
        $query = StoryCategory::query();
        $query->select(['cat_id', 'cat_name', 'cat_image']);

        return $query->get()->toJson();
    }

    /**
     * story list my given category
     * @param  array $params input parameters
     * @return string   json format story list
     */
    public function story_list_by_cat()
    {
        $params = $this->data;
        $query = Story::query();
        $query->select(['story_id', 'story_name', 'story_cover_image']);

        if ($params['catid']) {
            $query->where('cat_id', '=', $params['catid']);
        }

        return $query->get()->toJson();
    }

    /**
     * Story list that will display in banner
     * @$params array   $params input parameters
     * @return  string  json format story list
     */
    function story_banner_list()
    {
        $query = Story::query();
        $query->select(['story_id', 'story_name', 'story_cover_image']);
        $query->where('is_banner', '=', 1);

        return $query->get()->toJson();
    }

    /**
     * Story list that will display in popular sector
     * @$params array   $params input parameters
     * @return  string  json format story list
     */
    function story_popular_list()
    {
        $query = Story::query();
        $query->select(['story_id', 'story_name', 'story_cover_image']);

        return $query->get()->toJson();
    }
}
