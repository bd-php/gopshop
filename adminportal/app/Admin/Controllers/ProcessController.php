<?php
#app/Http/Admin/Controllers/ProcessController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StoryPageButtons;
use App\Models\StoryPages;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Excel;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description(' ')
            ->body('');
    }

    public function importStory(Content $content, Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $validatedData = \Validator::make($request->all(), [
                'import_file' => 'required|mimes:xlsx',
            ]);
            if ($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData->errors());
            } else {
                Excel::load($request->file('import_file'), function ($reader) use ($request) {
                    $reader->skipRows(1); //
                    $arrError = array();
                    $arrSuccess = array();

                    $login_user_id = Admin::user()->id;
                    $currenttime = with(new StoryPages)->freshTimestamp();

                    $fullarray = $reader->toArray();
                    $page_array = $fullarray[0];
                    $button_array = $fullarray[1];
                    //dd($fullarray);

                    $storyid = (int)$page_array[0]['story_id'];

                    $story_table_name = with(new StoryPages)->getTable();
                    $story_btn_table_name = with(new StoryPageButtons)->getTable();

                    $q = 'DELETE t1, t2 FROM ' . $story_table_name . ' t1 LEFT JOIN ' . $story_btn_table_name . ' t2 ON (t1.page_id=t2.page_id) WHERE t1.story_id = ?';
                    $deleted_row_num = \DB::delete($q, array($storyid));
                    //dd($deleted_row_num);

                    $array_insertid_map = array();

                    foreach ($page_array as $key => $row) {
                        try {
                            $arrMapping = array();
                            $story_id = (int)$row['story_id'];
                            if ($story_id == 0) {
                                continue;
                            }
                            $arrMapping['story_id'] = (int)$row['story_id'];
                            $arrMapping['validity_check'] = $row['validity_check'];
                            $arrMapping['validity_failed_msg'] = $row['validity_failed_msg'];
                            $arrMapping['background_image'] = $row['background_image'];
                            $arrMapping['dialogue_text'] = $row['dialogue_text'];
                            $arrMapping['dialogue_type'] = $row['dialogue_type'];
                            $arrMapping['char_id'] = (int)$row['char_id'];
                            $arrMapping['mood_id'] = (int)$row['mood_id'];
                            $arrMapping['char_alignment'] = $row['char_alignment'];
                            $arrMapping['next_page_id'] = (int)$row['next_page_id'];
                            $arrMapping['page_added_by'] = $login_user_id;
                            $arrMapping['page_added_time'] = $currenttime;
                            //dd($arrMapping);

                            $id = StoryPages::insertGetId($arrMapping);
                            $array_insertid_map[$row['serial']] = $id;

                            $arrSuccess[] = $row['serial'];
                        } catch (\Exception $e) {
                            //$arrError[] = $row['sku'] . ': have error ' . $e->getMessage();
                            $arrError[] = $row['serial'] . ': have error';
                        }

                    }
                    //dd($array_insertid_map);
                    foreach ($page_array as $key => $row) {
                        try {
                            $nxt_id = (int)$row['next_page_id'];
                            if ($nxt_id == 0) {
                                continue;
                            }
                            StoryPages::where('page_id', $array_insertid_map[$row['serial']])->update(['next_page_id' => $array_insertid_map[$nxt_id]]);
                        } catch (\Exception $e) {
                            dd($e->getMessage());
                            //$arrError[] = $row['sku'] . ': have error ' . $e->getMessage();
                            $arrError[] = $row['serial'] . ': have error';
                        }
                    }

                    //dd($array_insertid_map);
                    $array_bulk_btns = [];

                    foreach ($button_array as $key => $row) {

                        $arrMapping = array();

                        $page_id = (int)$row['page_id'];
                        if ($page_id == 0) {
                            continue;
                        }
                        $arrMapping['page_id'] = $array_insertid_map[$page_id];
                        $arrMapping['btn_title'] = $row['btn_title'];
                        $arrMapping['next_pageid'] = $array_insertid_map[(int)$row['next_pageid']];
                        $arrMapping['btn_added_by'] = $login_user_id;
                        $arrMapping['btn_added_time'] = $currenttime;
                        $array_bulk_btns[] = $arrMapping;
                    }

                    $status = StoryPageButtons::insert($array_bulk_btns);
                    //dd($status);

                    if ($arrSuccess) {
                        $request->session()->flash('import_success', $arrSuccess);
                    }
                    if ($arrError) {
                        $request->session()->flash('import_error', $arrError);
                    }
                    return back();
                });
            }
        }

        return $content
            ->header('Import Story')
            ->description(' ')
            ->body($this->getImportProduct());
    }

    public
    function getImportProduct()
    {
        return view('admin.ImportProduct')->render();

    }

}
