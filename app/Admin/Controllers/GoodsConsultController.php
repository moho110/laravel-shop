<?php

namespace App\Admin\Controllers;

use App\Models\Goods;
use App\Models\GoodsConsult;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class GoodsConsultController extends AdminController
{
    protected $title = "商品咨询表";

    public function index(Content $content)
    {
        return $content
            ->header('商品咨询表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new GoodsConsult());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('goodsId', __('商品id'));
                $grid->column('userId', __('用户id'));
                $grid->column('consultType', __('咨询类别'));
                $grid->column('createTime', __('咨询时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new GoodsConsult());
                $form->select('goodsId', __('商品id'))
                ->options(Goods::pluck('goodsName','id'))
                ->creationRules('required|max:200|unique:goods_consult',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('userId', __('用户id'))
                ->creationRules('required|max:500',
                        ['required' => '此项不能为空','max' =>'不能大于500个字符']);
                $form->text('consultType', __('咨询类别'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('consultContent', __('咨询内容'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('createTime', __('咨询时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->textarea('reply', __('商家回复'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('replyTime', __('回复时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->radio('dataFlag', __('数据有效标志'))->options(['1' => '删除','0' => '有效'])
                ->rules('required');
                $form->radio('isShow', __('是否显示数据'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('商品咨询表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('商品咨询表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new GoodsConsult());
        return $content
            ->header('商品咨询表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(GoodsConsult::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('goodsId', __('商品id'));
        $show->field('userId', __('用户id'));
        $show->field('consultType', __('咨询类别'));
        $show->field('consultContent', __('咨询内容'));
        $show->field('createTime', __('咨询时间'));
        $show->field('reply', __('商家回复'));
        $show->field('replyTime', __('回复时间'));
        $show->field('dataFlag', __('数据有效标志'));
        $show->field('isShow', __('是否显示数据'));
        return $show;
        }
}
