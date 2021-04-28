<?php

namespace App\Admin\Controllers;

use App\Models\Navs;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class NavsController extends AdminController
{
    protected $title = "商城导航信息表";

    public function index(Content $content)
    {
        return $content
            ->header('商城导航信息表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Navs());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('navTitle', __('导航标题'));
                $grid->column('navUrl', __('导航网址'));
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Navs());
                $form->text('navType', __('导航类型'))
                ->creationRules('required|max:200|unique:navs',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('navTitle', __('导航标题'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('navUrl', __('导航网址'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isShow', __('是否显示'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->currency('isOpen', __('是否新开窗口'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->number('navSort', __('排序号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('商城导航信息表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('商城导航信息表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Navs());
        return $content
            ->header('商城导航信息表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Navs::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('navType', __('导航类型'));
        $show->field('navTitle', __('导航标题'));
        $show->field('navUrl', __('导航网址'));
        $show->field('isShow', __('是否显示'));
        $show->field('isOpen', __('是否新开窗口'));
        $show->field('navSort', __('排序号'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
