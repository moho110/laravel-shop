<?php

namespace App\Admin\Controllers;

use App\Models\Freights;
use App\Models\Areas;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class FreightsController extends AdminController
{
    protected $title = "运费配置表";

    public function index(Content $content)
    {
        return $content
            ->header('运费配置表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Freights());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('areaId2', __('市级ID'));
                $grid->column('freight', __('运费'));
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Freights());
                $form->select('areaId2', __('市级ID'))
                ->options(Areas::pluck('areaName','id'))
                ->creationRules('required|max:200|unique:freight',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->currency('freight', __('运费'))->symbol('rmb')
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('运费配置表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('运费配置表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Freights());
        return $content
            ->header('运费配置表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Freights::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('areaId2', __('市级ID'));
        $show->field('freight', __('运费'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
