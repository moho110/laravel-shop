<?php

namespace App\Admin\Controllers;

use App\Models\GoodsCats;
use App\Models\Goods;
use App\Models\SpecItems;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class SpecItemsController extends AdminController
{
    protected $title = "规格属性表";

    public function index(Content $content)
    {
        return $content
            ->header('规格属性表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new SpecItems());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('shopId', __('店铺ID'));
                $grid->column('catId', __('类型ID'));
                $grid->column('goodsId', __('商品ID'));
                $grid->column('itemName', __('项名称'));
                $grid->column('createTime', '创建时间');

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new SpecItems());
                $form->text('shopId', __('店铺ID'))
                ->creationRules('required|max:200|unique:spec_items',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->select('catId', __('类型ID'))
                ->options(GoodsCats::pluck('catName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->select('goodsId', __('商品ID'))
                ->options(Goods::pluck('goodsName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('itemName', __('项名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('itemDesc', __('规格说明'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->image('itemImg', __('规格图片'))
                ->rules('required');
                $form->radio('dataFlag', __('有效状态'))->options(['1' => '有效','-1' => '无效'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required', ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('规格属性表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('规格属性表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new SpecItems());
        return $content
            ->header('规格属性表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(SpecItems::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('shopId', __('店铺ID'));
        $show->field('catId', __('类型ID'));
        $show->field('goodsId', __('商品ID'));
        $show->field('itemName', __('项名称'));
        $show->field('itemDesc', __('规格说明'));
        $show->field('itemImg', __('规格图片'));
        $show->field('dataFlag', __('有效状态'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
