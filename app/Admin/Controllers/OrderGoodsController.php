<?php

namespace App\Admin\Controllers;

use App\Models\Goods;
use App\Models\Orders;
use App\Models\OrderGoods;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class OrderGoodsController extends AdminController
{
    protected $title = "订单-商品表";

    public function index(Content $content)
    {
        return $content
            ->header('订单-商品表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new OrderGoods());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('goodsNum', __('商品数量'));
                $grid->column('goodsPrice', __('商品价格'));
                $grid->column('goodsName', __('商品名称'));
                $grid->column('goodsImg', __('商品图'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new OrderGoods());
                $form->select('orderId', __('订单ID'))
                ->options(Orders::pluck('orderNo','id'))
                ->creationRules('required|max:200|unique:order_goods',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->select('goodsId', __('商品ID'))
                ->options(Goods::pluck('goodsName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('goodsNum', __('商品数量'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->currency('goodsPrice', __('商品价格'))->symbol('rmb')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('goodsSpecId', __('商品-规格ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('goodsSpecNames', __('商品-规格值列表'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('goodsName', __('商品名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->image('goodsImg', __('商品图'))
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('订单-商品表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('订单-商品表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new OrderGoods());
        return $content
            ->header('订单-商品表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(OrderGoods::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('orderId', __('订单ID'));
        $show->field('goodsId', __('商品ID'));
        $show->field('goodsNum', __('商品数量'));
        $show->field('goodsPrice', __('商品价格'));
        $show->field('goodsSpecId', __('商品-规格ID'));
        $show->field('goodsSpecNames', __('商品-规格值列表'));
        $show->field('goodsName', __('商品名称'));
        $show->field('goodsImg', __('商品图'));
        return $show;
        }
}
