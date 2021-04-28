<?php

namespace App\Admin\Controllers;

use App\Models\Banks;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class BanksController extends AdminController
{
    protected $title = "银行列表";

    public function index(Content $content)
    {
        return $content
            ->header('银行列表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Banks());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('bankName', __('银行名称'));
                $grid->column('dataFlag', '删除标志')
                    ->display(function ($dataFlag) {
                        return $dataFlag ? '<span style="color:green;">删除</span>' : '<span style="color:red;">有效</span>';
                    });
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Banks());
                $form->text('bankName', __('银行名称'))
                ->creationRules('required|max:200|unique:banks',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->radio('dataFlag', __('删除标志'))->options(['1' => '删除','0' => '有效'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('银行列表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('银行列表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Banks());
        return $content
            ->header('银行列表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Banks::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('bankName', __('银行名称'));
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
