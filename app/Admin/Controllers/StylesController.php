<?php

namespace App\Admin\Controllers;

use App\Models\Styles;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class StylesController extends AdminController
{
    protected $title = "商城风格记录表";

    public function index(Content $content)
    {
        return $content
            ->header('商城风格记录表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Styles());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('styleSys', __('系统类型'));
                $grid->column('styleName', __('风格名称'));
                $grid->column('styleAuthor', __('风格开发者'));
                $grid->column('styleShopSite', __('风格开发者站点'));
                $grid->column('styleShopId', '店铺风格ID');
                $grid->column('stylePath', __('风格目录名称'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Styles());
                $form->text('styleSys', __('系统类型'))
                ->creationRules('required|max:200|unique:styles',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('styleName', __('风格名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('styleAuthor', __('风格开发者'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('styleShopSite', __('风格开发者站点'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('styleShopId', __('店铺风格ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('stylePath', __('风格目录名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isUse', __('是否使用中'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('商城风格记录表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('商城风格记录表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Styles());
        return $content
            ->header('商城风格记录表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Styles::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('styleSys', __('系统类型'));
        $show->field('styleName', __('风格名称'));
        $show->field('styleAuthor', __('风格开发者'));
        $show->field('styleShopSite', __('风格开发者站点'));
        $show->field('styleShopId', __('店铺风格ID'));
        $show->field('stylePath', __('风格目录名称'));
        $show->field('isUse', __('是否使用中'));
        return $show;
        }
}
