<?php

namespace App\Admin\Controllers;

use App\Models\Favorites;
use App\Models\Goods;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class FavoritesController extends AdminController
{
    protected $title = "关注商品/商家表";

    public function index(Content $content)
    {
        return $content
            ->header('关注商品/商家表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Favorites());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('userId', __('用户ID'));
                $grid->column('goodsId', __('商品ID'));
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Favorites());
                $form->text('userId', __('用户ID'))
                ->creationRules('required|max:200|unique:favorites',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->select('goodsId', __('商品ID'))
                ->options(Goods::pluck('goodsName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('关注商品/商家表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('关注商品/商家表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Favorites());
        return $content
            ->header('关注商品/商家表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Favorites::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('userId', __('用户ID'));
        $show->field('goodsId', __('商品ID'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
