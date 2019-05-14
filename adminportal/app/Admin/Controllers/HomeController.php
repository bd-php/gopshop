<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopOrder;
use App\Models\ShopProduct;
use App\User;
use DB;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Table;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header(trans('language.admin.dashboard'));
            $content->description(' ');
            /*
            $content->row(function ($row) {
                $row->column(4, new InfoBox(trans('language.admin.total_product'), 'tags', 'aqua', route('productControl.index'), ShopProduct::all()->count()));
                $row->column(4, new InfoBox(trans('language.admin.total_order'), 'shopping-cart', 'green', route('orderControl.index'), ShopOrder::all()->count()));
                $row->column(4, new InfoBox(trans('language.admin.total_customer'), 'user', 'yellow', route('customerControl.index'), User::all()->count()));
            });

// in 30 days
            $content->row(function (Row $row) {
                $totals = ShopOrder::select(DB::raw('DATE(created_at) as date, sum(total) as total_amount, count(id) as total_order'))
                    ->groupBy('date')
                    ->having('date', '<=', date('Y-m-d'))
                    ->whereRaw('DATE(created_at) >=  DATE_SUB(DATE(NOW()), INTERVAL 1 MONTH)')
                    ->get();

                $arrDays         = [];
                $arrTotalsOrder  = [];
                $arrTotalsAmount = [];
                $rangDays        = new \DatePeriod(
                    new \DateTime('-1 MONTH'),
                    new \DateInterval('P1D'),
                    new \DateTime('+1 day')
                );
                foreach ($rangDays as $i => $day) {
                    $arrDays[$i]         = $day->format('m/d');
                    $arrTotalsAmount[$i] = 0;
                    $arrTotalsOrder[$i]  = 0;
                }

                foreach ($totals as $key => $value) {
                    $day                   = (int) date('d', strtotime($value->date));
                    $arrTotalsAmount[$day] = $value->total_amount;
                    $arrTotalsOrder[$day]  = $value->total_order;
                }
                $max_order = max($arrTotalsOrder);
                foreach ($arrTotalsAmount as $key => $value) {
                    if ($key != 0) {
                        $key_first = $key - 1;
                        $arrTotalsAmount[$key] += $arrTotalsAmount[$key_first];
                    }
                }
                $arrDays         = '["' . implode('","', $arrDays) . '"]';
                $arrTotalsAmount = '[' . implode(',', $arrTotalsAmount) . ']';
                $arrTotalsOrder  = '[' . implode(',', $arrTotalsOrder) . ']';

                $chartMonth = view('admin.chart.chartMonth', compact(['arrDays', 'arrTotalsAmount', 'arrTotalsOrder', 'max_order']));
                $row->column(12, new Box(trans('language.admin.order_month'), $chartMonth));
            });

//===================12 months  ==============================
            $content->row(function (Row $row) {
                for ($i = 12; $i >= 0; $i--) {
                    $months1[$i]              = date("m/Y", strtotime(date('Y-m-01') . " -$i months"));
                    $months2[$i]              = date("Y-m", strtotime(date('Y-m-01') . " -$i months"));
                    $arrTotalsAmount_year[$i] = 0;
                }

                $totals_month = ShopOrder::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as ym, sum(total) as total_amount, count(id) as total_order'))
                    ->groupBy('ym')
                    ->having('ym', '>=', $months2[12])
                    ->having('ym', '<=', $months2[0])
                    ->get();
                foreach ($totals_month as $key => $value) {
                    $key_month                        = array_search($value->ym, $months2);
                    $arrTotalsAmount_year[$key_month] = $value->total_amount;
                }
                $months1              = '["' . implode('","', $months1) . '"]';
                $arrTotalsAmount_year = '[' . implode(',', $arrTotalsAmount_year) . ']';

                $chartYear = view('admin.chart.chartYear', compact(['arrTotalsAmount_year', 'totals_month', 'months1', 'max_order']));
                $row->column(12, new Box(trans('language.admin.order_year'), $chartYear));
            });

//===================new customers  ==============================
            $users = User::select('id', 'email', 'name', 'phone', 'created_at')->orderBy('id', 'desc')
                ->limit(10)->get()
                ->each(function ($item) {
                    $item->setAppends([]);
                })->toArray();
            $headers = ['Id', 'Email', 'Name', 'Phone', 'Time'];
            $rows    = $users;
            $content->row((new Box(trans('language.admin.new_customer'), new Table($headers, $rows)))->style('info')->solid());
            */
        });
    }
}
