<?php

namespace App\Admin\Controllers;

use App\Models\Datas;
use App\Models\DataCats;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class DatasController extends AdminController
{
    protected $title = "数据表";

    public function index(Content $content)
    {
        return $content
            ->header('数据表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Datas());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('catId', __('分类ID'));
                $grid->column('dataName', __('数据名称'));
                $grid->column('dataVal', __('数据值'));
                $grid->column('dataSort', __('数据排序'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Datas());
                $form->select('catId', __('分类ID'))
                ->options(DataCats::pluck('catName','id'))
                ->creationRules('required|max:200|unique:datas',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('dataName', __('数据名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('dataVal', __('数据值'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('dataSort', __('数据排序'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('数据表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('数据表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Datas());
        return $content
            ->header('数据表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Datas::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('catId', __('分类ID'));
        $show->field('dataName', __('数据名称'));
        $show->field('dataVal', __('数据值'));
        $show->field('dataSort', __('排序号'));
        return $show;
        }
}
