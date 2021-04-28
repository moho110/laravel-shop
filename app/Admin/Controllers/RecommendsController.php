<?php

namespace App\Admin\Controllers;

use App\Models\Recommends;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class RecommendsController extends AdminController
{
    protected $title = "推荐商品、店铺、品牌记录表";

    public function index(Content $content)
    {
        return $content
            ->header('推荐商品、店铺、品牌记录表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Recommends());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('goodsCatId', __('商品分类ID'));
                $grid->column('dataType', __('数据类型'));
                $grid->column('dataSrc', __('数据来源'));
                $grid->column('dataId', __('数据在其表中的主键'));
                $grid->column('dataSort', '数据排序号');

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Recommends());
                $form->text('goodsCatId', __('商品分类ID'))
                ->creationRules('required|max:200|unique:recommends',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('dataType', __('数据类型'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('dataSrc', __('数据来源'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('dataId', __('数据在其表中的主键'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('dataSort', __('数据排序号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('推荐商品、店铺、品牌记录表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('推荐商品、店铺、品牌记录表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Recommends());
        return $content
            ->header('推荐商品、店铺、品牌记录表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Recommends::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('goodsCatId', __('商品分类ID'));
        $show->field('dataType', __('数据类型'));
        $show->field('dataSrc', __('数据来源'));
        $show->field('dataId', __('数据在其表中的主键'));
        $show->field('dataSort', __('数据排序号'));
        return $show;
        }
}
