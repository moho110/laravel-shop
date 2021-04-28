<?php

namespace App\Admin\Controllers;

use App\Models\SysConfigs;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class SysConfigsController extends AdminController
{
    protected $title = "商城配置表";

    public function index(Content $content)
    {
        return $content
            ->header('商城配置表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new SysConfigs());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('fieldName', __('字段名称'));
                $grid->column('fieldCode', __('字段代码'));
                $grid->column('fieldValue', __('字段值'));
                $grid->column('fieldType', __('字段类型'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new SysConfigs());
                $form->text('fieldName', __('字段名称'))
                ->creationRules('required|max:200|unique:sys_configs',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('fieldCode', __('字段代码'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('fieldValue', __('字段值'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('fieldType', __('字段类型'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('商城配置表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('商城配置表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new SysConfigs());
        return $content
            ->header('商城配置表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(SysConfigs::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('fieldName', __('字段名称'));
        $show->field('fieldCode', __('字段代码'));
        $show->field('fieldValue', __('字段值'));
        $show->field('fieldType', __('字段类型'));
        return $show;
        }
}
