<?php

namespace App\Admin\Controllers;

use App\Models\Roles;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class RolesController extends AdminController
{
    protected $title = "管理后台角色表";

    public function index(Content $content)
    {
        return $content
            ->header('管理后台角色表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Roles());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('roleName', __('角色名称'));
                $grid->column('privileges', __('权限列表'));
                $grid->column('dataFlag', __('有效状态'));
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Roles());
                $form->text('roleName', __('角色名称'))
                ->creationRules('required|max:200|unique:roles',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->textarea('roleDesc', __('角色描述'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('privileges', __('权限列表'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('dataFlag', __('有效状态'))->options(['1' => '有效','0' => '无效'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('管理后台角色表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('管理后台角色表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Roles());
        return $content
            ->header('管理后台角色表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Roles::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('roleName', __('角色名称'));
        $show->field('roleDesc', __('角色描述'));
        $show->field('privileges', __('权限列表'));
        $show->field('dataFlag', __('有效状态'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
