<?php

namespace App\Admin\Controllers;

use App\Models\Goods;
use App\Models\GoodsScores;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class GoodsScoresController extends AdminController
{
    protected $title = "商品-评分表";

    public function index(Content $content)
    {
        return $content
            ->header('商品-评分表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new GoodsScores());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('goodsId', __('商品ID'));
                $grid->column('totalScore', __('总评分'));
                $grid->column('totalUsers', __('总评评分用户数'));
                $grid->column('goodsScore', __('商品评分'));
                $grid->column('goodsUsers', '商品评分用户数');
                $grid->column('timeScore', __('时效评分'));
                $grid->column('timeUsers', __('时效评分用户数'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new GoodsScores());
                $form->select('goodsId', __('商品ID'))
                ->options(Goods::pluck('goodsName','id'))
                ->creationRules('required|max:200|unique:goods_scores',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('totalScore', __('总评分'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('totalUsers', __('总评评分用户数'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('goodsScore', __('商品评分'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('goodsUsers', __('商品评分用户数'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于2个字符']);
                $form->text('serviceScore', __('服务评分'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于2个字符']);
                $form->text('serviceUsers', __('服务评分用户数'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('timeScore', __('时效评分'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('timeUsers', __('时效评分用户数'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('商品-评分表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('商品-评分表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new GoodsScores());
        return $content
            ->header('商品-评分表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(GoodsScores::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('goodsId', __('商品ID'));
        $show->field('totalScore', __('总评分'));
        $show->field('totalUsers', __('总评评分用户数'));
        $show->field('goodsScore', __('商品评分'));
        $show->field('goodsUsers', __('商品评分用户数'));
        $show->field('serviceScore', __('服务评分'));
        $show->field('serviceUsers', __('服务评分用户数'));
        $show->field('timeScore', __('时效评分'));
        $show->field('timeUsers', __('时效评分用户数'));
        return $show;
        }
}
