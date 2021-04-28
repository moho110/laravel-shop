<?php

namespace App\Admin\Controllers;

use App\Models\GoodsCats;
use App\Models\SpecCats;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class SpecCatsController extends AdminController
{
    protected $title = "商品规格表";

    public function index(Content $content)
    {
        return $content
            ->header('商品规格表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new SpecCats());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('goodsCatId', __('最后一级商品分类ID'));
                $grid->column('goodsCatPath', __('商品分类路径'));
                $grid->column('catName', __('类型名称'));
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new SpecCats());
                $form->select('goodsCatId', __('最后一级商品分类ID'))
                ->options(GoodsCats::pluck('catName','id'))
                ->creationRules('required|max:200|unique:spec_cats',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('goodsCatPath', __('商品分类路径'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('catName', __('类型名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isAllowImg', __('是否允许上传图片'))->options(['1' => '允许','0' => '不允许'])
                ->rules('required');
                $form->radio('isShow', __('是否显示'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->number('catSort', __('排序号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('dataFlag', __('有效状态'))->options(['1' => '有效','-1' => '无效'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required', ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('商品规格表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('商品规格表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new SpecCats());
        return $content
            ->header('商品规格表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(SpecCats::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('goodsCatId', __('最后一级商品分类ID'));
        $show->field('goodsCatPath', __('商品分类路径'));
        $show->field('catName', __('类型名称'));
        $show->field('isAllowImg', __('是否允许上传图片'));
        $show->field('isShow', __('是否显示'));
        $show->field('catSort', __('排序号'));
        $show->field('dataFlag', __('有效状态'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
