<?php

namespace App\Admin\Controllers;

use App\Models\ArticleCats;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class UsersController extends AdminController
{
    protected $title = "用户信息表";

    public function index(Content $content)
    {
        return $content
            ->header('用户信息表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Users());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('bankid', __('帐户ID'));
                $grid->column('bankcode', __('银行代码'));
                $grid->column('bankname', __('银行名称'));
                $grid->column('syslock', __('系统锁定'));
                $grid->column('jine', '金额');
                $grid->column('belong', __('所属'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Users());
                $form->text('bankid', __('帐户ID'))
                ->creationRules('required|max:200|unique:cmf_bank',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('bankcode', __('银行代码'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('bankname', __('银行名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('syslock', __('系统锁定'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->currency('jine', __('金额'))->symbol('rmb')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于2个字符']);
                $form->radio('belong', __('所属'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('用户信息表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('用户信息表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Users());
        return $content
            ->header('用户信息表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Users::findOrFail($id));

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
