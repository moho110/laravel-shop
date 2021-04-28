<?php

namespace App\Admin\Controllers;

use App\Models\Privileges;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Tree;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\RedirectResponse;

class PrivilegesController extends AdminController
{
    protected $title = "管理后台权限配置表";

    public function index(Content $content)
    {
        return $content->title('后台权限配置列表')
            ->description('列表')
            ->row(function (Row $row){
                // 显示分类树状图
                $row->column(6, $this->treeView()->render());
 
                $row->column(6, function (Column $column){
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('shop/privileges'));
                    $form->select('menuId', __('父ID'))->options(Privileges::selectOptions());
                    $form->text('privilegeCode', __('权限代码'))
                    ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                    $form->text('privilegeName', __('权限名称'))
                    ->creationRules('required|max:200|unique:privileges',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                    $form->radio('isMenuPrivilege', __('是否菜单权限'))->options(['1' => '是','0' => '否'])
                    ->rules('required');
                    $form->text('privilegeUrl', __('主权限URL'))
                    ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                    $form->text('otherPrivilegeUrl', __('其他权限URL'))
                    ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                    $form->radio('dataFlag', __('有效状态'))->options(['1' => '删除','0' => '有效'])
                    ->rules('required');
                    $form->hidden('_token')->default(csrf_token());
                    $column->append((new Box(__('新增后台权限配置'), $form))->style('success'));
                });
            });
    }

        /**
     * 树状视图
     * @return Tree
     */
        protected function treeView()
        {
            return  Privileges::tree(function (Tree $tree){
                $tree->disableCreate(); // 关闭新增按钮
                $tree->branch(function ($branch) {
                    return "<strong>{$branch['privilegeName']}</strong>"; // 标题添加strong标签
                });
            });
        }

        protected function form()
        {
                $form = new Form(new Privileges());
                $form->text('menuId', __('父ID'))
                ->options(Privileges::selectOptions())
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('privilegeCode', __('权限代码'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('privilegeName', __('权限名称'))
                ->creationRules('required|max:200|unique:privileges',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->radio('isMenuPrivilege', __('是否菜单权限'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->text('privilegeUrl', __('主权限URL'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('otherPrivilegeUrl', __('其他权限URL'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('dataFlag', __('有效状态'))->options(['1' => '有效','-1' => '无效'])
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('管理后台权限配置表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('管理后台权限配置表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Privileges());
        return $content
            ->header('管理后台权限配置表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Privileges::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('menuId', __('父ID'));
        $show->field('privilegeCode', __('权限代码'));
        $show->field('privilegeName', __('权限名称'));
        $show->field('isMenuPrivilege', __('是否菜单权限'));
        $show->field('privilegeUrl', __('主权限URL'));
        $show->field('otherPrivilegeUrl', __('其他权限URL'));
        $show->field('dataFlag', __('有效状态'));
        return $show;
        }
}
