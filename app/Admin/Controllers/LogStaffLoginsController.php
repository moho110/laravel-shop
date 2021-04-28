<?php

namespace App\Admin\Controllers;

use App\Models\Staffs;
use App\Models\LogStaffLogins;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class LogStaffLoginsController extends AdminController
{
    protected $title = "管理员登录记录表";

    public function index(Content $content)
    {
        return $content
            ->header('管理员登录记录表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new LogStaffLogins());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('staffId', __('职员ID'));
                $grid->column('loginTime', __('登录时间'));
                $grid->column('loginIp', __('登录IP'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new LogStaffLogins());
                $form->select('staffId', __('职员ID'))
                ->options(Staffs::pluck('staffName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('loginTime', __('登录时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->ip('loginIp', __('登录IP'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('管理员登录记录表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('管理员登录记录表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new LogStaffLogins());
        return $content
            ->header('管理员登录记录表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(LogStaffLogins::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('staffId', __('职员ID'));
        $show->field('loginTime', __('登录时间'));
        $show->field('loginIp', __('登录IP'));
        return $show;
        }
}
