<?php

namespace App\Admin\Controllers;

use App\Models\Goods;
use App\Models\GoodsVirtuals;
use App\Models\Orders;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class GoodsVirtualsController extends AdminController
{
    protected $title = "虚拟商品-卡券表";

    public function index(Content $content)
    {
        return $content
            ->header('虚拟商品-卡券表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new GoodsVirtuals());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('goodsId', __('商品ID'));
                $grid->column('cardNo', __('卡券号'));
                $grid->column('orderId', __('订单Id'));
                $grid->column('orderNo', __('订单号'));
                $grid->column('dataFlag', __('有效标志'));
                $grid->column('createTime', __('创建时间表'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new GoodsVirtuals());
                $form->select('goodsId', __('商品ID'))
                ->options(Goods::pluck('goodsName','id'))
                ->creationRules('required|max:200|unique:goods_virtuals',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('cardNo', __('卡券号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->password('cardPwd', __('卡券密码'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->select('orderId', __('订单Id'))
                ->options(Orders::pluck('orderNo','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('orderNo', __('订单号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isUse', __('是否使用'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->radio('dataFlag', __('有效标志'))->options(['1' => '有效','-1' => '无效'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间表'))
                ->creationRules('required', ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('虚拟商品-卡券表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('虚拟商品-卡券表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new GoodsVirtuals());
        return $content
            ->header('虚拟商品-卡券表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(GoodsVirtuals::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('goodsId', __('商品ID'));
        $show->field('cardNo', __('卡券号'));
        $show->field('cardPwd', __('卡券密码'));
        $show->field('orderId', __('订单Id'));
        $show->field('orderNo', __('订单号'));
        $show->field('isUse', __('是否使用'));
        $show->field('dataFlag', __('有效标志'));
        $show->field('createTime', __('创建时间表'));
        return $show;
        }
}
