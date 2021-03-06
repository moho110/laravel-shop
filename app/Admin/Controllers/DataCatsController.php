<?php

namespace App\Admin\Controllers;

use App\Models\DataCats;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Tree;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\RedirectResponse;

class DataCatsController extends AdminController
{
    protected $title = "数据分类表";

    public function index(Content $content)
    {
        return $content->title('数据分类表')
            ->description('列表')
            ->row(function (Row $row){
                // 显示分类树状图
                $row->column(6, $this->treeView()->render());
 
                $row->column(6, function (Column $column){
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('shop/data_cats'));
                    $form->select('parentId', __('父ID'))->options(DataCats::selectOptions());
                    $form->radio('isShow', __('是否显示'))->options(['1' => '是','0' => '否'])
                    ->rules('required');
                    $form->text('catName', __('分类名称'))
                    ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                    $form->number('catSort', __('分类排序'))->default(99)->help('越小越靠前')
                    ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                    $form->radio('dataFlag', __('删除标志'))->options(['1' => '删除','0' => '有效'])
                    ->rules('required');
                    $form->datetime('createTime', __('创建时间'))
                    ->creationRules('required',
                        ['required' => '此项不能为空']);
                    $form->hidden('_token')->default(csrf_token());
                    $column->append((new Box(__('新增文章分类'), $form))->style('success'));
                });
 
            });
    }

        /**
     * 树状视图
     * @return Tree
     */
        protected function treeView()
        {
            return  DataCats::tree(function (Tree $tree){
                $tree->disableCreate(); // 关闭新增按钮
                $tree->branch(function ($branch) {
                    return "<strong>{$branch['catName']}</strong>"; // 标题添加strong标签
                });
            });
        }

        protected function form()
        {
            $form = new Form(new DataCats());
            $form->select('parentId', __('父ID'))->options(DataCats::selectOptions());
            $form->radio('isShow', __('是否显示'))->options(['1' => '是','0' => '否'])
            ->rules('required');
            $form->text('catName', __('分类名称'))
            ->creationRules('required|max:200|unique:data_cats',
                ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
            $form->number('catSort', __('分类排序'))->default(99)->help('越小越靠前')
            ->creationRules('required|max:200',
                ['required' => '此项不能为空','max' =>'不能大于200个字符']);
            $form->radio('dataFlag', __('删除标志'))->options(['1' => '删除','0' => '有效'])
            ->rules('required');
            $form->datetime('createTime', __('创建时间'))
            ->creationRules('required',
                ['required' => '此项不能为空']);
            return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('数据分类表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('数据分类表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new DataCats());
        return $content
            ->header('数据分类表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
            $show = new Show(DataCats::findOrFail($id));
            $show->field('id', __('编号'));
            $show->field('parentId', __('父ID'));
            $show->field('isShow', __('是否显示'))->as(function($isShow) {
                if($isShow == 1) {
                    $isShow='是';
                }else {
                    $isShow='否';
                }
                return $isShow;
            });
            $show->field('catName', __('分类名称'));
            $show->field('catSort', __('分类排序'));
            $show->field('dataFlag', __('删除标志'))->as(function($dataFlag) {
                if($dataFlag == 1) {
                    $dataFlag='删除';
                }else {
                    $dataFlag='有效';
                }
                return $dataFlag;
            });
            $show->field('createTime', __('创建时间'));
            return $show;
        }
}
