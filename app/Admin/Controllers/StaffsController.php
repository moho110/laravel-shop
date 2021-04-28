<?php

namespace App\Admin\Controllers;

use App\Models\Staffs;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class StaffsController extends AdminController
{
    protected $title = "管理员表";

    public function index(Content $content)
    {
        return $content
            ->header('管理员表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Staffs());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('loginName', __('账号'));
                $grid->column('staffName', __('职员名称'));
                $grid->column('staffNo', __('职员编号'));
                $grid->column('dataFlag', __('删除标志'));
                $grid->column('createTime', '创建时间');
                $grid->column('lastIP', __('最后登录IP'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Staffs());
                $form->text('loginName', __('账号'))
                ->creationRules('required|max:200|unique:staffs',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->password('loginPwd', __('密码'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('secretKey', __('安全码'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('staffName', __('职员名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('staffNo', __('职员编号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->image('staffPhoto', __('职员头像'))
                ->rules('required');
                $form->text('staffRoleId', __('职员角色ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('workStatus', __('工作状态'))->options(['1' => '在职','0' => '离职'])
                ->rules('required');
                $form->radio('staffStatus', __('职员状态'))->options(['1' => '正常','0' => '停用'])
                ->rules('required');
                $form->radio('dataFlag', __('删除标志'))->options(['1' => '有效','-1' => '无效'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',['required' => '此项不能为空']);
                $form->datetime('lastTime', __('最后登录时间'))
                ->creationRules('required',['required' => '此项不能为空']);
                $form->ip('lastIP', __('最后登录IP'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('管理员表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('管理员表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Staffs());
        return $content
            ->header('管理员表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Staffs::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('loginName', __('账号'));
        $show->field('loginPwd', __('密码'));
        $show->field('secretKey', __('安全码'));
        $show->field('staffName', __('职员名称'));
        $show->field('staffNo', __('职员编号'));
        $show->field('staffPhoto', __('职员头像'));
        $show->field('staffRoleId', __('职员角色ID'));
        $show->field('workStatus', __('工作状态'));
        $show->field('staffStatus', __('职员状态'));
        $show->field('dataFlag', __('删除标志'));
        $show->field('createTime', __('创建时间'));
        $show->field('lastTime', __('最后登录时间'));
        $show->field('lastIP', __('最后登录IP'));
        return $show;
        }
}
