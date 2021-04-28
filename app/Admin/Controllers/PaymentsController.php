<?php

namespace App\Admin\Controllers;

use App\Models\Payments;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class PaymentsController extends AdminController
{
    protected $title = "支付方式配置表";

    public function index(Content $content)
    {
        return $content
            ->header('支付方式配置表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Payments());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('payCode', __('支付code'));
                $grid->column('payName', __('支付方式名称'));
                $grid->column('payOrder', __('排序号'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Payments());
                $form->text('payCode', __('支付code'))
                ->creationRules('required|max:200|unique:payments',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('payName', __('支付方式名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('payDesc', __('支付方式描述'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('payOrder', __('排序号'))
                ->rules('required');
                $form->text('payConfig', __('参数配置'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('enabled', __('是否启用'))->options(['1' => '启用','0' => '不启用'])
                ->rules('required');
                $form->radio('isOnline', __('是否在线支付'))->options(['1' => '在线支付','0' => '否'])
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('支付方式配置表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('支付方式配置表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Payments());
        return $content
            ->header('支付方式配置表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Payments::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('payCode', __('支付code'));
        $show->field('payName', __('支付方式名称'));
        $show->field('payDesc', __('支付方式描述'));
        $show->field('payOrder', __('排序号'));
        $show->field('payConfig', __('参数配置'));
        $show->field('enabled', __('是否启用'));
        $show->field('isOnline', __('是否在线支付'));
        return $show;
        }
}
