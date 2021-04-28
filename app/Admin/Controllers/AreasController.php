<?php

namespace App\Admin\Controllers;

use App\Models\Areas;
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

class AreasController extends AdminController
{
    protected $title = "区域列表";

    public function index(Content $content)
    {
        return $content->title('区域列表')
            ->description('列表')
            ->row(function (Row $row){
                // 显示分类树状图
                $row->column(6, $this->treeView()->render());
 
                $row->column(6, function (Column $column){
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('shop/areas'));
                    $form->select('parentId', __('父ID'))->options(Areas::selectOptions());
                    $form->text('areaName', __('地区名称'))
                    ->creationRules('required|max:200|unique:areas',
                    ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                    $form->radio('isShow', __('是否显示'))->options(['1' => '是','0' => '否'])
                    ->rules('required');
                    $form->number('areaSort', __('排序号'))->default(99)->help('越小越靠前');
                    $form->text('areaKey', __('地区首字母'))
                    ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                    $form->radio('areaType', __('级别标志'))->options(['1' => '省','2' => '市','3' => '县区'])
                    ->rules('required');
                    $form->radio('dataFlag', __('删除标志'))->options(['1' => '删除','0' => '有效'])
                    ->rules('required');
                    $form->datetime('createTime', __('创建时间'))
                    ->creationRules('required',
                        ['required' => '此项不能为空']);
                    $form->hidden('_token')->default(csrf_token());
                    $column->append((new Box(__('新增区域'), $form))->style('success'));
                });
 
            });
    }
    /**
     * 树状视图
     * @return Tree
     */
        protected function treeView()
        {
            return  Areas::tree(function (Tree $tree){
                $tree->disableCreate(); // 关闭新增按钮
                $tree->branch(function ($branch) {
                    return "<strong>{$branch['areaName']}</strong>"; // 标题添加strong标签
                });
            });
        }

        protected function form()
        {
                $form = new Form(new Areas());
                $form->display('id', '编号');
                $form->select('parentId', __('父ID'))
                ->options(Areas::selectOptions())
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('areaName', __('地区名称'))
                ->creationRules('required|max:200|unique:areas',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->radio('isShow', __('是否显示'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->number('areaSort', __('排序号'))->help('越小越靠前')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('areaKey', __('地区首字母'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('areaType', __('级别标志'))->options(['1' => '省','2' => '市','3' => '县区'])
                ->rules('required');
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
            ->header('区域列表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Areas());
        return $content
            ->header('区域列表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Areas::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('parentId', __('父ID'));
        $show->field('areaName', __('地区名称'));
        $show->field('isShow', __('是否显示'))->as(function($isShow) {
            if($isShow == 1) {
                $isShow='是';
            }else {
                $isShow='否';
            }
            return $isShow;
        });
        $show->field('areaSort', __('排序号'));
        $show->field('areaKey', __('地区首字母'));
        $show->field('areaType', __('级别标志'))->as(function($areaType) {
            if($areaType == 1) {
                $areaType='省';
            }else if($areaType == 2) {
                $areaType='市';
            }else {
                $areaType='县区';
            }
            return $areaType;
        });
        $show->field('dataFlag', __('删除标志'))->as(function($dataFlag) {
            if($dataFlag == 1) {
                $dataFlag='删除';
            }else {
                $dataFlag='有效';
            }
            return $dataFlag;
        });
        $show->field('createTime', __('银行代码'));
        return $show;
        }
}
