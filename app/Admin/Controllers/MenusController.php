<?php

namespace App\Admin\Controllers;

use App\Models\Menus;
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

class MenusController extends AdminController
{
    protected $title = "管理后台菜单表";

    public function index(Content $content)
    {
        return $content->title('菜单列表')
            ->description('列表')
            ->row(function (Row $row){
                // 显示分类树状图
                $row->column(6, $this->treeView()->render());
 
                $row->column(6, function (Column $column){
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('shop/menus'));
                    $form->select('parentId', __('父ID'))->options(Menus::selectOptions());
                    $form->text('menuName', __('菜单名称'))
                    ->creationRules('required|max:200|unique:menus',
                    ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                    $form->number('menuSort', __('排序号'))->default(99)->help('越小越靠前');
                    $form->radio('dataFlag', __('删除标志'))->options(['1' => '删除','0' => '有效'])
                    ->rules('required');
                    $form->hidden('_token')->default(csrf_token());
                    $column->append((new Box(__('新增菜单'), $form))->style('success'));
                });
 
            });
    }

        /**
     * 树状视图
     * @return Tree
     */
        protected function treeView()
        {
            return  Menus::tree(function (Tree $tree){
                $tree->disableCreate(); // 关闭新增按钮
                $tree->branch(function ($branch) {
                    return "<strong>{$branch['menuName']}</strong>"; // 标题添加strong标签
                });
            });
        }

        protected function form()
        {
                $form = new Form(new Menus());
                $form->select('parentId', __('父ID'))
                ->options(Menus::selectOptions())
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('menuName', __('菜单名称'))
                ->creationRules('required|max:200|unique:menus',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->number('menuSort', __('排序号'))->help('越小越靠前')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('dataFlag', __('删除标志'))->options(['1' => '删除','0' => '有效'])
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('管理后台菜单表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('管理后台菜单表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Menus());
        return $content
            ->header('管理后台菜单表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Menus::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('parentId', __('父ID'));
        $show->field('menuName', __('菜单名称'));
        $show->field('menuSort', __('菜单排序'));
        $show->field('dataFlag', __('有效状态'));
        return $show;
        }
}
