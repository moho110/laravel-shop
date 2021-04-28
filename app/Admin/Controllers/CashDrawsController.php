<?php

namespace App\Admin\Controllers;

use App\Models\Areas;
use App\Models\Banks;
use App\Models\CashDraws;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class CashDrawsController extends AdminController
{
    protected $title = "提现记录表";

    public function index(Content $content)
    {
        return $content
            ->header('提现记录表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new CashDraws());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('cashNo', __('提现单号'));
                $grid->column('targetType', __('提现对象'));
                $grid->column('targetId', __('提现对象ID'));
                $grid->column('money', __('金额'));
                $grid->column('accType', '提现类型');
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new CashDraws());
                $form->text('cashNo', __('提现单号'))
                ->creationRules('required|max:200|unique:cash_draws',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->radio('targetType', __('提现对象'))->options(['1' => '用户','0' => '商家'])
                ->rules('required');
                $form->text('targetId', __('提现对象ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->currency('money', __('金额'))->symbol('rmb')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('accType', __('提现类型'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->select('accTargetName', __('开卡银行名称'))
                ->options(Banks::pluck('bankName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->select('accAreaName', __('开卡地区名称'))
                ->options(Areas::pluck('areaName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('accNo', __('卡号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('accUser', __('持卡人'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('cashSatus', __('提现状态'))->options(['-1' => '提现失败','0' => '待处理','1' => '提现成功'])
                ->rules('required');
                $form->textarea('cashRemarks', __('提现备注'))->options(['1' => '是','0' => '否'])
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('cashConfigId', __('提现设置对应的ID'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('提现记录表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('提现记录表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new CashDraws());
        return $content
            ->header('提现记录表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(CashDraws::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('cashNo', __('提现单号'));
        $show->field('targetType', __('提现对象'));
        $show->field('targetId', __('提现对象ID'));
        $show->field('money', __('金额'));
        $show->field('accType', __('提现类型'));
        $show->field('accTargetName', __('开卡银行名称'));
        $show->field('accAreaName', __('开卡地区名称'));
        $show->field('accNo', __('卡号'));
        $show->field('accUser', __('持卡人'));
        $show->field('cashSatus', __('提现状态'));
        $show->field('cashRemarks', __('提现备注'));
        $show->field('cashConfigId', __('提现设置对应的ID'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
