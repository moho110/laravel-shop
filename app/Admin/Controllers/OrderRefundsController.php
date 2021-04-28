<?php

namespace App\Admin\Controllers;

use App\Models\OrderRefunds;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class OrderRefundsController extends AdminController
{
    protected $title = "订单退款表";

    public function index(Content $content)
    {
        return $content
            ->header('订单退款表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new OrderRefunds());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('orderId', __('订单ID'));
                $grid->column('refundTo', __('管理员退款方向'));
                $grid->column('backMoney', __('用户退款金额'));
                $grid->column('refundTradeNo', __('管理员退款流水号'));
                $grid->column('refundTime', '管理员退款时间');
                $grid->column('createTime', __('用户申请退款时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new OrderRefunds());
                $form->text('orderId', __('订单ID'))
                ->creationRules('required|max:200|unique:order_refunds',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('refundTo', __('管理员退款方向'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('refundReson', __('用户申请退款原因ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('refundOtherReson', __('用户申请退款原因'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->decimal('backMoney', __('用户退款金额'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('refundTradeNo', __('管理员退款流水号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('refundRemark', __('管理员退款备注'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('refundTime', __('管理员退款时间'))
                ->creationRules('required', ['required' => '此项不能为空']);
                $form->textarea('shopRejectReason', __('店铺不同意拒收原因'))
                ->creationRules('required', ['required' => '此项不能为空']);
                $form->radio('refundStatus', __('退款状态'))->options(['1' => '已处理','0' => '等待商家处理'])
                ->rules('required');
                $form->datetime('createTime', __('用户申请退款时间'))
                ->creationRules('required', ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('订单退款表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('订单退款表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new OrderRefunds());
        return $content
            ->header('订单退款表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(OrderRefunds::findOrFail($id));

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
