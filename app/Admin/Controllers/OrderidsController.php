<?php

namespace App\Admin\Controllers;

use App\Models\Orderids;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class OrderidsController extends AdminController
{
    protected $title = "订单ID生成记录表";

    public function index(Content $content)
    {
        return $content
            ->header('订单ID生成记录表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Orderids());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('orderids', __('毫秒数'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Orderids());
                $form->text('orderids', __('毫秒数'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('订单ID生成记录表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('订单ID生成记录表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Orderids());
        return $content
            ->header('订单ID生成记录表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Orderids::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('orderids', __('毫秒数'));
        return $show;
        }
}
