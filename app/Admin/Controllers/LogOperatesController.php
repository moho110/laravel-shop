<?php

namespace App\Admin\Controllers;

use App\Models\LogOperates;
use App\Models\HomeMenus;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class LogOperatesController extends AdminController
{
    protected $title = "操作记录表";

    public function index(Content $content)
    {
        return $content
            ->header('操作记录表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new LogOperates());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('staffId', __('职员ID'));
                $grid->column('operateTime', __('操作时间'));
                $grid->column('menuId', __('所属菜单ID'));
                $grid->column('operateUrl', __('操作连接地址'));
                $grid->column('operateIP', '操作IP');

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new LogOperates());
                $form->text('staffId', __('职员ID'))
                ->creationRules('required|max:200|unique:log_operates',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->datetime('operateTime', __('操作时间'))
                ->creationRules('required', ['required' => '此项不能为空']);
                $form->select('menuId', __('所属菜单ID'))
                ->options(HomeMenus::pluck('menuName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('operateDesc', __('操作说明'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->url('operateUrl', __('操作连接地址'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于2个字符']);
                $form->textarea('content', __('请求内容'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->ip('operateIP', __('操作IP'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('操作记录表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('操作记录表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new LogOperates());
        return $content
            ->header('操作记录表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(LogOperates::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('bankid', __('帐户ID'));
        $show->field('bankcode', __('银行代码'));
        $show->field('bankname', __('银行名称'));
        $show->field('syslock', __('系统锁定'));
        $show->field('jine', __('金额'));
        $show->field('belong', __('所属'));
        return $show;
        }
}
