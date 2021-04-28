<?php

namespace App\Admin\Controllers;

use App\Models\LogOrders;
use App\Models\Orders;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class LogOrdersController extends AdminController
{
    protected $title = "订单日志表";

    public function index(Content $content)
    {
        return $content
            ->header('订单日志表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new LogOrders());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('orderId', __('父级ID'));
                $grid->column('orderStatus', __('订单状态'));
                $grid->column('logTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new LogOrders());
                $form->select('orderId', __('父级ID'))
                ->options(Orders::pluck('orderNo','id'))
                ->creationRules('required|max:200|unique:log_orders',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->radio('orderStatus', __('订单状态'))->options(['0' => '待发货','1' => '待收货','2' => '已收货','-1' => '已取消','-2' => '待支付','-3' => '用户拒收','-4' => '商家同意拒收','-5' => '商家不同意拒收'])
                ->rules('required');
                $form->textarea('logContent', __('操作日志'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('logUserId', __('操作者ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('logType', __('操作者类型'))->options(['0' => '顾客/门店','1' => '商城职员'])
                ->rules('required');
                $form->datetime('logTime', __('创建时间'))
                ->creationRules('required', ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('订单日志表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('订单日志表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new LogOrders());
        return $content
            ->header('订单日志表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(LogOrders::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('orderId', __('父级ID'));
        $show->field('orderStatus', __('订单状态'));
        $show->field('logContent', __('操作日志'));
        $show->field('logUserId', __('操作者ID'));
        $show->field('logType', __('操作者类型'));
        $show->field('logTime', __('创建时间'));
        return $show;
        }
}
