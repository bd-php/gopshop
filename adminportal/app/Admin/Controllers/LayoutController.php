<?php
#app/Http/Admin/Controllers/LayoutController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Layout;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class LayoutController extends Controller
{
    use HasResourceActions;
    const META   = 'meta';
    const TOP    = 'top';
    const HEADER = 'header';
    const BOTTOM = 'bottom';
    const FOOTER = 'footer';
    //
    const HOME           = 'home';
    const CMS_LIST       = 'cms_list';
    const CMS_DETAIL     = 'cms_detail';
    const CMS_PAGE       = 'cms_page';
    const ABOUT          = 'about';
    const CONTACT        = 'contact';
    const PRODUCT_LIST   = 'product_list';
    const PRODUCT_DETAIL = 'product_detail';
    const SHOP_CART      = 'shop_cart';
    const SHOP_ACCOUNT   = 'shop_account';
    const SHOP_PROFILE   = 'shop_profile';
    const SHOP_COMPARE   = 'shop_compare';
    const SHOP_WISHLIST  = 'shop_wishlist';
    protected $arrDisplay;
    protected $arrPosition;

    public function __construct()
    {
        $this->arrDisplay = [
            self::HOME           => trans('language.layout.home'),
            self::CMS_LIST       => trans('language.layout.cms_list'),
            self::CMS_DETAIL     => trans('language.layout.cms_detail'),
            self::CMS_PAGE       => trans('language.layout.cms_page'),
            self::ABOUT          => trans('language.layout.about'),
            self::CONTACT        => trans('language.layout.contact'),
            self::PRODUCT_LIST   => trans('language.layout.product_list'),
            self::PRODUCT_DETAIL => trans('language.layout.product_detail'),
            self::SHOP_CART      => trans('language.layout.shop_cart'),
            self::SHOP_ACCOUNT   => trans('language.layout.shop_account'),
            self::SHOP_PROFILE   => trans('language.layout.shop_profile'),
            self::SHOP_COMPARE   => trans('language.layout.shop_compare'),
            self::SHOP_WISHLIST  => trans('language.layout.shop_wishlist'),
        ];
        $this->arrPosition = [
            self::META   => trans('language.layout.meta'),
            self::HEADER => trans('language.layout.header'),
            self::TOP    => trans('language.layout.top'),
            self::FOOTER => trans('language.layout.footer'),
            self::BOTTOM => trans('language.layout.bottom'),
        ];
    }

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->row('<span style="font-size:15px;font-style: italic;">(' . trans('language.layout.guide') . ')</span><br>')
            ->header(trans('language.layout.manager'))
            ->description(' ')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header(trans('language.layout.manager'))
            ->description(' ')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header(trans('language.layout.manager'))
            ->description(' ')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header(trans('language.layout.manager'))
            ->description(' ')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $arrDisplay  = $this->arrDisplay;
        $arrPosition = $this->arrPosition;
        $grid        = new Grid(new Layout);

        $grid->id('Id');
        $grid->name(trans('language.layout.name'));
        $grid->position(trans('language.layout.position'))->display(function ($value) use ($arrPosition) {
            return htmlentities($arrPosition[$value]);
        });
        $grid->page_display(trans('language.layout.page_display'))->display(function ($value) use ($arrDisplay) {
            if (!$value) {
                return trans('language.layout.all_page');
            } else {
                $html = '';
                if (is_array($value)) {
                    foreach ($value as $key => $v) {
                        $html .= '+' . $arrDisplay[$v] . '<br>';
                    }
                }
                return $html;
            }

        })->style('max-width:200px;word-break:break-all;');
        $grid->html('Html')->display(function ($value) {
            return htmlentities($value);
        })->style('max-width:200px;word-break:break-all;');
        $grid->status(trans('language.layout.status'))->switch();
        $grid->sort(trans('language.layout.sort'));
        $grid->disableRowSelector();
        $grid->disableFilter();
        $grid->tools(function ($tools) {
            $tools->disableRefreshButton();
        });
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        $grid->model()->orderBy('id', 'desc');
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Layout::findOrFail($id));
        $show->id('Id');
        $show->name(trans('language.layout.name'));
        $show->position(trans('language.layout.position'));
        $show->page_display(trans('language.layout.page_display'));
        $show->html('Html');
        $show->status(trans('language.layout.status'));
        $show->sort(trans('language.layout.sort'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Layout);
        $form->text('name', trans('language.layout.name'))->rules('required');
        $form->select('position', trans('language.layout.position'))->options($this->arrPosition)->rules('required');
        $form->listbox('page_display', trans('language.layout.page_display'))->options($this->arrDisplay);
        $form->textarea('html', 'Html');
        $form->switch('status', trans('language.layout.status'));
        $form->number('sort', trans('language.layout.sort'));
        $form->disableViewCheck();
        $form->disableEditingCheck();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });
        return $form;
    }
}
