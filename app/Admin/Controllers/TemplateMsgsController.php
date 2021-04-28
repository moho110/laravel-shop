<?php

namespace App\Admin\Controllers;

use App\Models\TemplateMsgs;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class TemplateMsgsController extends AdminController
{
    protected $title = "消息模板表";

    public function index(Content $content)
    {
        return $content
            ->header('消息模板表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new TemplateMsgs());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('tplType', __('模板类型'));
                $grid->column('tplCode', __('模板代码'));
                $grid->column('dataFlag', __('有效标志'));
                $grid->column('status', __('状态'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new TemplateMsgs());
                $form->text('userId', __('用户ID'))
                ->creationRules('required|max:200|unique:template_msgs',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->radio('isCheck', __('是否检查'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->text('goodsId', __('商品ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('goodsSpecId', __('商品规格ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('cartNum', __('购物车数量'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('消息模板表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('消息模板表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new TemplateMsgs());
        return $content
            ->header('消息模板表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(TemplateMsgs::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('userId', __('用户ID'));
        $show->field('isCheck', __('是否检查'));
        $show->field('goodsId', __('商品ID'));
        $show->field('goodsSpecId', __('商品规格ID'));
        $show->field('cartNum', __('购物车数量'));
        return $show;
        }
}
