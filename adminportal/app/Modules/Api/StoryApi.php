<?php
#app/Modules/Api/Product.php
namespace App\Modules\Api;

use App\Models\Story;
use App\Models\StoryCategory;
use Illuminate\Http\Request;

class StoryApi extends General
{

    public $limit;
    public $start;
    public $orderBy;
    public $sort;
    public $model;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $data = $this->data;
        $this->limit = empty($data['limit']) ? -1 : $data['limit'];
        $this->start = empty($data['start']) ? 0 : (int)$data['start'];
        $this->orderBy = empty($data['orderBy']) ? [] : explode(',', $data['orderBy']);
        $this->sort = $data['sort'] ?? 'ASC';
        $this->model = empty($data['model']) ? '' : $data['model'];

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
        $limit = $this->limit;
        $start = $this->start;
        $orderBy = $this->orderBy;
        $sort = $this->sort;

        $query = StoryCategory::query();
        $query->select(['cat_id', 'cat_name', 'cat_image']);

        $hiddenFields = empty($this->hiddenFields) ? [] : explode(',', $this->hiddenFields);
//Order by
        if ($orderBy) {
            foreach ($orderBy as $order) {
                $query->orderBy($order, $sort);
            }
        }
//Limit
        if ($limit != -1) {
            $query->offset($start);
            $query->limit($limit);
        }

//Render
        return $query->get()->each(function ($item) use ($hiddenFields) {
            $item->setAppends([]);
            if ($hiddenFields) {
                $item->makeHidden($hiddenFields);
            }
        })->toJson();
    }

    /**
     * [story list my given category]
     * @param  [type] $params [description]
     * @return [type]      [description]
     */
    public function story_list_by_cat($params)
    {
        $limit = $this->limit;
        $start = $this->start;
        $orderBy = $this->orderBy;
        $sort = $this->sort;

        $query = Story::query();
        $query->select(['story_id', 'story_name', 'story_cover_image']);

        if ($params['catid']) {
            $query->where('cat_id', '=', $params['catid']);
        }

        $hiddenFields = empty($this->hiddenFields) ? [] : explode(',', $this->hiddenFields);
//Order by
        if ($orderBy) {
            foreach ($orderBy as $order) {
                $query->orderBy($order, $sort);
            }
        }
//Limit
        if ($limit != -1) {
            $query->offset($start);
            $query->limit($limit);
        }

//Render
        return $query->get()->each(function ($item) use ($hiddenFields) {
            $item->setAppends([]);
            if ($hiddenFields) {
                $item->makeHidden($hiddenFields);
            }
        })->toJson();
    }
}
