<?php

namespace App\Admin\Controllers;

use App\Models\Attributes;
use App\Models\GoodsAttributes;
use App\Models\Goods;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class GoodsAttributesController extends AdminController
{
    protected $title = "商品-属性表";

    public function index(Content $content)
    {
        return $content
            ->header('商品-属性表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new GoodsAttributes());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('goodsId', __('商品ID'));
                $grid->column('attrId', __('属性名称'));
                $grid->column('attrVal', __('属性值'));
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new GoodsAttributes());
                $form->select('goodsId', __('商品ID'))
                ->options(Goods::pluck('goodsName','id'))
                ->creationRules('required|max:200|unique:goods_attributes',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->select('attrId', __('属性名称'))
                ->options(Attributes::pluck('attrName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('attrVal', __('属性值'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('商品-属性表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('商品-属性表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new GoodsAttributes());
        return $content
            ->header('商品-属性表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(GoodsAttributes::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('goodsId', __('商品ID'));
        $show->field('attrId', __('属性名称'));
        $show->field('attrVal', __('属性值'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
