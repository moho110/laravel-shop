<?php

namespace App\Admin\Controllers;

use App\Models\Goods;
use App\Models\GoodsSpecs;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class GoodsSpecsController extends AdminController
{
    protected $title = "商品-规格信息表";

    public function index(Content $content)
    {
        return $content
            ->header('商品-规格信息表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new GoodsSpecs());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('goodsId', __('商品ID'));
                $grid->column('productNo', __('商品货号'));
                $grid->column('specIds', __('规格ID格式'));
                $grid->column('marketPrice', __('市场价'));
                $grid->column('specPrice', '商品价');
                $grid->column('specStock', __('库存'));
                $grid->column('warnStock', __('预警值'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new GoodsSpecs());
                $form->select('goodsId', __('商品ID'))
                ->options(Goods::pluck('goodsName','id'))
                ->creationRules('required|max:200|unique:goods_specs',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('productNo', __('商品货号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('specIds', __('规格ID格式'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('marketPrice', __('市场价'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('specPrice', __('商品价'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于2个字符']);
                $form->text('specStock', __('库存'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于2个字符']);
                $form->text('warnStock', __('预警值'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('saleNum', __('销量'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isDefault', __('默认规格'))->options(['1' => '默认规格','0' => '非默认规格'])
                ->rules('required');
                $form->radio('dataFlag', __('有效状态'))->options(['1' => '有效','0' => '无效'])
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('商品-规格信息表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('商品-规格信息表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new GoodsSpecs());
        return $content
            ->header('商品-规格信息表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(GoodsSpecs::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('goodsId', __('商品ID'));
        $show->field('productNo', __('商品货号'));
        $show->field('specIds', __('规格ID格式'));
        $show->field('marketPrice', __('市场价'));
        $show->field('specPrice', __('商品价'));
        $show->field('specStock', __('库存'));
        $show->field('warnStock', __('预警值'));
        $show->field('saleNum', __('销量'));
        $show->field('isDefault', __('默认规格'));
        $show->field('dataFlag', __('有效状态'));
        return $show;
        }
}
