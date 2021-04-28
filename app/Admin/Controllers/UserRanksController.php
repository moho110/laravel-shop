<?php

namespace App\Admin\Controllers;

use App\Models\UserRanks;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class UserRanksController extends AdminController
{
    protected $title = "用户等级表";

    public function index(Content $content)
    {
        return $content
            ->header('用户等级表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new UserRanks());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('rankName', __('等级名称'));
                $grid->column('startScore', __('开始积分'));
                $grid->column('endScore', __('结束积分'));
                $grid->column('dataFlag', __('删除标志'));
                $grid->column('createTime', '创建时间');

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new UserRanks());
                $form->text('rankName', __('等级名称'))
                ->creationRules('required|max:200|unique:cmf_bank',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('startScore', __('开始积分'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('endScore', __('结束积分'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->decimal('rebate', __('折扣'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->image('userrankImg', __('等级图标'))
                ->rules('required');
                $form->radio('dataFlag', __('删除标志'))->options(['1' => '有效','0' => '无效'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('用户等级表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('用户等级表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new UserRanks());
        return $content
            ->header('用户等级表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(UserRanks::findOrFail($id));

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
