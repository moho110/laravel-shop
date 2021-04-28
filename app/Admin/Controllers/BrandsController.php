<?php

namespace App\Admin\Controllers;

use App\Models\Brands;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class BrandsController extends AdminController
{
    protected $title = "品牌列表";

    public function index(Content $content)
    {
        return $content
            ->header('品牌列表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Brands());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('brandName', __('品牌名称'));
                $grid->column('brandImg')->gallery(['zooming' => true]);
                $grid->column('createTime', __('创建时间'));
                $grid->column('dataFlag', __('删除标志'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Brands());
                $form->text('brandName', __('品牌名称'))
                ->creationRules('required|max:200|unique:brands',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->image('brandImg', __('品牌图片'))
                ->creationRules('required|max:500',
                        ['required' => '此项不能为空','max' =>'不能大于500个字符']);
                $form->textarea('brandDesc', __('品牌描述'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->radio('dataFlag', __('删除标志'))->options(['1' => '删除','0' => '有效'])
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('品牌列表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('品牌列表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Brands());
        return $content
            ->header('品牌列表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Brands::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('brandName', __('品牌名称'));
        $show->field('brandImg', __('品牌图片'));
        $show->field('brandDesc', __('品牌描述'));
        $show->field('createTime', __('创建时间'));
        $show->field('dataFlag', __('删除标志'))->as(function($dataFlag) {
            if($dataFlag == 1) {
                $dataFlag='删除';
            }else {
                $dataFlag='有效';
            }
            return $dataFlag;
        });
        return $show;
        }
}
