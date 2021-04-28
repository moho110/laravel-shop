<?php

namespace App\Admin\Controllers;

use App\Models\CashConfigs;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class CashConfigsController extends AdminController
{
    protected $title = "提现信息表";

    public function index(Content $content)
    {
        return $content
            ->header('提现信息表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new CashConfigs());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('targetType', __('提现对象'));
                $grid->column('targetId', __('提现对象ID'));
                $grid->column('accType', __('提现类型'));
                $grid->column('accTargetId', __('银行卡ID'));
                $grid->column('dataFlag', '删除标志');
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new CashConfigs());
                $form->radio('targetType', __('提现对象'))->options(['1' => '用户','0' => '商家'])
                ->rules('required');
                $form->text('targetId', __('提现对象ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('accType', __('提现类型'))->options(['1' => '支付宝','2' => '微信','3' => '银行卡'])
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('accTargetId', __('银行卡ID'))->options(['1' => '支付宝','0' => '微信'])
                ->rules('required');
                $form->number('accAreaId', __('开卡地区ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('accNo', __('银行卡号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('accUser', __('持卡人'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('dataFlag', __('有效状态'))->options(['1' => '有效','0' => '删除'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('提现信息表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('提现信息表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new CashConfigs());
        return $content
            ->header('提现信息表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(CashConfigs::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('targetType', __('提现对象'));
        $show->field('targetId', __('提现对象ID'));
        $show->field('accType', __('提现类型'));
        $show->field('accTargetId', __('银行卡ID'));
        $show->field('accAreaId', __('开卡地区ID'));
        $show->field('accNo', __('银行卡号'));
        $show->field('accUser', __('持卡人'));
        $show->field('dataFlag', __('有效状态'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
