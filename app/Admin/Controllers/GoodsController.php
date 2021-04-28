<?php

namespace App\Admin\Controllers;

use App\Models\Brands;
use App\Models\Goods;
use App\Models\GoodsCats;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class GoodsController extends AdminController
{
    protected $title = "商品信息表";

    public function index(Content $content)
    {
        return $content
            ->header('商品信息表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Goods());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('goodsSn', __('商品编号'));
                $grid->column('goodsName', __('商品名称'));
                $grid->column('goodsImg', __('商品图片'));
                $grid->column('marketPrice', __('市场价'));
                $grid->column('shopPrice', '门店价');
                $grid->column('goodsUnit', __('单位'));
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Goods());
                $form->text('goodsSn', __('商品编号'))
                ->creationRules('required|max:200|unique:goods',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('productNo', __('商品货号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('goodsName', __('商品名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->image('goodsImg', __('商品图片'))
                ->rules('required');
                $form->currency('marketPrice', __('市场价'))->symbol('rmb')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->currency('shopPrice', __('门店价'))->symbol('rmb')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('warnStock', __('预警库存'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('goodsStock', __('商品总库存'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('goodsUnit', __('单位'))
                ->creationRules('required|max:500',
                        ['required' => '此项不能为空','max' =>'不能大于500个字符']);
                $form->textarea('goodsTips', __('促销信息'))
                ->creationRules('required|max:500',
                        ['required' => '此项不能为空','max' =>'不能大于500个字符']);
                $form->radio('isSale', __('是否上架'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->radio('isBest', __('是否精品'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->radio('isHot', __('是否热销产品'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->radio('isNew', __('是否新品'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->currency('isRecom', __('是否推荐'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->text('goodsCatIdPath', __('商品分类ID路径'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->select('goodsCatId', __('最后一级商品分类ID'))
                ->options(GoodsCats::pluck('catName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->select('brandId', __('品牌ID'))
                ->options(Brands::pluck('brandName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('goodsDesc', __('商品描述'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('saleNum', __('总销售量'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('saleTime', __('上架时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->number('visitNum', __('访问数'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('appraiseNum', __('评价数'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->image('gallery', __('商品相册'))
                ->rules('required');
                $form->text('goodsSeoKeywords', __('商品SEO关键字'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('dataFlag', __('删除标志'))->options(['1' => '删除','0' => '有效'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('商品信息表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('商品信息表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Goods());
        return $content
            ->header('商品信息表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Goods::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('goodsSn', __('商品编号'));
        $show->field('productNo', __('商品货号'));
        $show->field('goodsName', __('商品名称'));
        $show->field('goodsImg', __('商品图片'));
        $show->field('marketPrice', __('市场价'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
