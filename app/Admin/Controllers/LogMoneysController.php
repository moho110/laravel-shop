<?php

namespace App\Admin\Controllers;

use App\Models\LogMoneys;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class LogMoneysController extends AdminController
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
                $grid = new Grid(new LogMoneys());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('targetType', __('用户类型'));
                $grid->column('targetId', __('用户/商家ID'));
                $grid->column('dataId', __('数据记录ID'));
                $grid->column('dataSrc', __('流水来源'));
                $grid->column('dataFlag', '有效状态');
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new LogMoneys());
                $form->radio('targetType', __('用户类型'))->options(['1' => '商家','0' => '用户'])
                ->rules('required');
                $form->text('targetId', __('用户/商家ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('dataId', __('数据记录ID'))->options(['1' => '交易订单 ','2' => '积分支出'])
                ->rules('required');
                $form->radio('dataSrc', __('流水来源'))->options(['1' => '交易订单','2' => '订单结算','3' => '提现申请'])
                ->rules('required');
                $form->textarea('remark', __('流水备注'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('moneyType', __('流水标志'))->options(['1' => '收入','0' => '支出'])
                ->rules('required');
                $form->decimal('money', __('金额'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('tradeNo', __('外部流水号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('payType', __('支付方式'))->options(['0' => '平台','1' => '支付宝','2' => '微信'])
                ->rules('required');
                $form->radio('dataFlag', __('有效状态'))->options(['-1' => '无效','1' => '有效'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required', ['required' => '此项不能为空']);
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
            $form = new Form(new LogMoneys());
        return $content
            ->header('提现记录表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(LogMoneys::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('targetType', __('用户类型'));
        $show->field('targetId', __('用户/商家ID'));
        $show->field('dataId', __('数据记录ID'));
        $show->field('dataSrc', __('流水来源'));
        $show->field('remark', __('流水备注'));
        $show->field('moneyType', __('流水标志'));
        $show->field('money', __('金额'));
        $show->field('tradeNo', __('外部流水号'));
        $show->field('payType', __('支付方式'));
        $show->field('dataFlag', __('有效状态'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
