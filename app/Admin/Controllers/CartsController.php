<?php

namespace App\Admin\Controllers;

use App\Models\Carts;
use App\Models\Goods;
use App\Models\GoodsSpecs;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class CartsController extends AdminController
{
    protected $title = "购物车列表";

    public function index(Content $content)
    {
        return $content
            ->header('购物车列表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Carts());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('userId', __('用户ID'));
                $grid->column('isCheck', __('是否检查'));
                $grid->column('goodsId', __('商品ID'));
                $grid->column('goodsSpecId', __('商品规格ID'));
                $grid->column('cartNum', '购物车数量');

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Carts());
                $form->text('userId', __('用户ID'))
                ->creationRules('required|max:200|unique:carts',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->radio('isCheck', __('是否检查'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->select('goodsId', __('商品ID'))
                ->options(Goods::pluck('goodsName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->select('goodsSpecId', __('商品规格ID'))
                ->options(GoodsSpecs::pluck('productNo','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('cartNum', __('购物车数量'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('购物车列表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('购物车列表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Carts());
        return $content
            ->header('购物车列表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Carts::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('userId', __('用户ID'));
        $show->field('isCheck', __('是否检查'));
        $show->field('goodsId', __('商品ID'));
        $show->field('goodsSpecId', __('商品规格ID'));
        $show->field('cartNum', __('购物车数量'));
        return $show;
        }
}
