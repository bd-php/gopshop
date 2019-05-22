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

        $query = $request->query();
        $this->apiName = $query['Apiname'] ?? '';

        if ($this->apiName == '') {
            $error = array(
                'error' => 1,
                'code' => 404,
                'detail' => 'Api name not found',
                'msg' => 'Not found'
            );
            header('Content-Type: application/json');
            echo json_encode($error, JSON_UNESCAPED_UNICODE);
            exit;
        }
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
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    function story_cat_list($params)
    {
        $query = StoryCategory::query();
        $query->select(['cat_id', 'cat_name', 'cat_image']);

        return $query->get()->toJson();
    }

    /**
     * [story list my given category]
     * @param  [type] $params [description]
     * @return [type]      [description]
     */
    public function story_list_by_cat($params)
    {
        $query = Story::query();
        $query->select(['story_id', 'story_name', 'story_cover_image']);

        if ($params['catid']) {
            $query->where('cat_id', '=', $params['catid']);
        }

        return $query->get()->toJson();
    }
}
