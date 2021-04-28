<?php

namespace App\Admin\Controllers;

use App\Models\CatBrands;
use App\Models\Brands;
use App\Models\GoodsCats;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class CatBrandsController extends AdminController
{
    protected $title = "商品分类-品牌关联表";

    public function index(Content $content)
    {
        return $content
            ->header('商品分类-品牌关联表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new CatBrands());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('catId', __('分类ID'));
                $grid->column('brandId', __('品牌ID'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new CatBrands());
                $form->select('catId', __('分类ID'))
                ->options(GoodsCats::pluck('catName','id'))
                ->creationRules('required|max:200|unique:cat_brands',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->select('brandId', __('品牌ID'))
                ->options(Brands::pluck('brandName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('商品分类-品牌关联表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('商品分类-品牌关联表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new CatBrands());
        return $content
            ->header('商品分类-品牌关联表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(CatBrands::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('catName', __('分类ID'))->as(function ($GoodsCats) {
                return $this->GoodsCats['catName'];
            });
        $show->field('brandName', __('品牌ID'))->as(function ($Brands) {
                return $this->Brands['brandName'];
            });
        return $show;
        }
}
