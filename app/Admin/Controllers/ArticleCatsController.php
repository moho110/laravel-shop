<?php

namespace App\Admin\Controllers;

use App\Models\ArticleCats;
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

class ArticleCatsController extends AdminController
{
    protected $title = "文章分类";

    public function index(Content $content)
    {
        return $content->title('文章列表')
            ->description('列表')
            ->row(function (Row $row){
                // 显示分类树状图
                $row->column(6, $this->treeView()->render());
 
                $row->column(6, function (Column $column){
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('shop/article_cats'));
                    $form->select('parentId', __('父ID'))->options(ArticleCats::selectOptions());
                    $form->radio('catType', __('分类类型'))->options(['1' => '普通类型 ','0' => '系统菜单'])
                    ->rules('required');
                    $form->radio('isShow', __('是否显示'))->options(['1' => '是','0' => '否'])
                    ->rules('required');
                    $form->text('catName', __('分类名称'))
                    ->creationRules('required|max:200|unique:article_cats',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
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
            return  ArticleCats::tree(function (Tree $tree){
                $tree->disableCreate(); // 关闭新增按钮
                $tree->branch(function ($branch) {
                    return "<strong>{$branch['catName']}</strong>"; // 标题添加strong标签
                });
            });
        }

        protected function form()
        {
                $form = new Form(new ArticleCats());
                $form->select('parentId', __('父ID'))->options(ArticleCats::selectOptions());
                $form->radio('catType', __('分类类型'))->options(['1' => '普通类型 ','0' => '系统菜单'])
                    ->rules('required');
                    $form->radio('isShow', __('是否显示'))->options(['1' => '是','0' => '否'])
                    ->rules('required');
                    $form->text('catName', __('分类名称'))
                    ->creationRules('required|max:200|unique:article_cats',
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

        public function show($id, Content $content)
        {
        return $content
            ->header('文章分类')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new ArticleCats());
        return $content
            ->header('文章分类')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(ArticleCats::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('parentId', __('父ID'));
        $show->field('catType', __('分类类型'))->as(function($catType) {
            if($catType == 1) {
                $catType='普通类型';
            }else if($catType == 0) {
                $catType='系统菜单';
            }

            return $catType;
        });
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
