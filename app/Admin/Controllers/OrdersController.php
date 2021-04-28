<?php

namespace App\Admin\Controllers;

use App\Models\Express;
use App\Models\Orders;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class OrdersController extends AdminController
{
    protected $title = "订单信息表";

    public function index(Content $content)
    {
        return $content
            ->header('订单信息表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Orders());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('orderNo', __('订单号'));
                $grid->column('goodsMoney', __('商品总金额'));
                $grid->column('deliverMoney', __('运费'));
                $grid->column('totalMoney', __('订单总金额'));
                $grid->column('realTotalMoney', '实际订单总金额');
                $grid->column('createTime', __('下单时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Orders());
                $form->text('orderNo', __('订单号'))
                ->creationRules('required|max:200|unique:orders',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('userId', __('用户ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->currency('goodsMoney', __('商品总金额'))->symbol('rmb')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('deliverType', __('收货方式'))->options(['1' => '自提','0' => '送货上门'])
                ->rules('required');
                $form->currency('deliverMoney', __('运费'))->symbol('rmb')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->currency('totalMoney', __('订单总金额'))->symbol('rmb')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->currency('realTotalMoney', __('实际订单总金额'))->symbol('rmb')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('orderStatus', __('订单状态'))->options(['-3' => '用户拒收','-2' => '未付款的订单 ','-1' => '用户取消','0' => '待发货','1' => '配送中','2' => '用户确认收货'])
                ->rules('required');
                $form->radio('payType', __('支付方式'))->options(['1' => '在线支付','0' => '货到付款'])
                ->rules('required');
                $form->radio('payFrom', __('支付来源'))->options(['1' => '支付宝','0' => '微信'])
                ->rules('required');
                $form->radio('isPay', __('是否支付'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->text('areaId', __('最后一级区域ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('areaIdPath', __('区域ID路径'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('userName', __('收货人名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('userAddress', __('收件人地址'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('userPhone', __('收件人手机号码'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('orderScore', __('所得积分'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isInvoice', __('是否需要发票'))->options(['1' => '需要','0' => '不需要'])
                ->rules('required');
                $form->text('invoiceClient', __('发票抬头'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('orderRemarks', __('订单备注'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('orderSrc', __('订单来源'))->options(['0' => '商城','1' => '微信','2' => '手机版','3' => '安卓App','4' => '苹果App' ,'5' => '小程序'])
                ->rules('required');
                $form->currency('needPay', __('需缴费用'))->symbol('rmb')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isRefund', __('是否退款'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->radio('isAppraise', __('是否点评'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->textarea('cancelReason', __('取消原因ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('rejectReason', __('拒收原因ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('rejectOtherReason', __('拒收原因'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isClosed', __('是否订单已完结'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->text('goodsSearchKeys', __('商品搜索关键字'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('receiveTime', __('收货时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->datetime('deliveryTime', __('发货时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->select('expressId', __('快递公司ID'))
                ->options(Express::pluck('expressName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('expressNo', __('快递号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('tradeNo', __('在线支付交易流水'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->currency('dataFlag', __('有效标志'))->options(['1' => '有效','0' => '无效'])
                ->rules('required');
                $form->datetime('createTime', __('下单时间'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('订单信息表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('订单信息表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Orders());
        return $content
            ->header('订单信息表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Orders::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('orderNo', __('订单号'));
        $show->field('userId', __('用户ID'));
        $show->field('goodsMoney', __('商品总金额'));
        $show->field('deliverType', __('收货方式'));
        $show->field('deliverMoney', __('运费'));
        $show->field('totalMoney', __('订单总金额'));
        $show->field('realTotalMoney', __('实际订单总金额'));
        $show->field('orderStatus', __('订单状态'));
        $show->field('payType', __('支付方式'));
        $show->field('payFrom', __('支付来源'));
        $show->field('isPay', __('是否支付'));
        $show->field('areaId', __('最后一级区域ID'));
        $show->field('areaIdPath', __('区域ID路径'));
        $show->field('userName', __('收货人名称'));
        $show->field('userAddress', __('收件人地址'));
        $show->field('userPhone', __('收件人手机号码'));
        $show->field('orderScore', __('所得积分'));
        $show->field('isInvoice', __('是否需要发票'));
        $show->field('invoiceClient', __('发票抬头'));
        $show->field('orderRemarks', __('订单备注'));
        $show->field('orderSrc', __('订单来源'));
        $show->field('needPay', __('需缴费用'));
        $show->field('isRefund', __('是否退款'));
        $show->field('isAppraise', __('是否点评'));
        $show->field('cancelReason', __('取消原因ID'));
        $show->field('rejectReason', __('拒收原因ID'));
        $show->field('rejectOtherReason', __('拒收原因'));
        $show->field('isClosed', __('是否订单已完结'));
        $show->field('goodsSearchKeys', __('商品搜索关键字'));
        $show->field('receiveTime', __('收货时间'));
        $show->field('deliveryTime', __('发货时间'));
        $show->field('expressId', __('快递公司ID'));
        $show->field('expressNo', __('快递号'));
        $show->field('tradeNo', __('在线支付交易流水'));
        $show->field('dataFlag', __('有效标志'));
        $show->field('createTime', __('下单时间'));
        return $show;
        }
}
