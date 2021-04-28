<?php

namespace App\Admin\Controllers;

use App\Models\GoodsAppraises;
use App\Models\Orders;
use App\Models\Goods;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class GoodsAppraisesController extends AdminController
{
    protected $title = "商品评价表";

    public function index(Content $content)
    {
        return $content
            ->header('商品评价表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new GoodsAppraises());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('orderId', __('订单ID'));
                $grid->column('goodsId', __('商品ID'));
                $grid->column('goodsSpecId', __('商品-规格ID'));
                $grid->column('userId', __('会员ID'));
                $grid->column('goodsScore', '商品评分');
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new GoodsAppraises());
                $form->select('orderId', __('订单ID'))
                ->options(Orders::pluck('orderNo','id'))
                ->creationRules('required|max:200|unique:goods_appraises',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->select('goodsId', __('评价对象ID'))
                ->options(Goods::pluck('goodsName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('goodsSpecId', __('商品-规格ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('userId', __('会员ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('goodsScore', __('商品评分'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('serviceScore', __('服务评分'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('timeScore', __('时效评分'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('content', __('点评内容'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('shopReply', __('店铺回复'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->image('images', __('上传图片'))
                ->rules('required');
                $form->radio('isShow', __('是否显示'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->radio('dataFlag', __('有效状态'))->options(['1' => '有效','0' => '删除'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->datetime('replyTime', __('商家回复时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('商品评价表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('商品评价表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new GoodsAppraises());
        return $content
            ->header('商品评价表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(GoodsAppraises::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('orderId', __('订单ID'));
        $show->field('goodsId', __('评价对象ID'));
        $show->field('goodsSpecId', __('商品-规格ID'));
        $show->field('userId', __('会员ID'));
        $show->field('goodsScore', __('商品评分'));
        $show->field('serviceScore', __('服务评分'));
        $show->field('timeScore', __('时效评分'));
        $show->field('content', __('点评内容'));
        $show->field('shopReply', __('店铺回复'));
        $show->field('images', __('上传图片'));
        $show->field('isShow', __('是否显示'));
        $show->field('dataFlag', __('有效状态'));
        $show->field('createTime', __('创建时间'));
        $show->field('replyTime', __('商家回复时间'));
        return $show;
        }
}
