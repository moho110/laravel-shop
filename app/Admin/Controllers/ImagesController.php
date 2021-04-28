<?php

namespace App\Admin\Controllers;

use App\Models\Images;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class ImagesController extends AdminController
{
    protected $title = "图像信息表";

    public function index(Content $content)
    {
        return $content
            ->header('图像信息表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Images());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('imgPath', __('图片路径'))->image();
                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Images());
                $form->text('fromType', __('来自类型'))
                ->creationRules('required|max:200|unique:images',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('dataId', __('数据ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->image('imgPath', __('图像路径'))
                ->rules('required');
                $form->text('imgSize', __('图像大小'))
                ->rules('required');
                $form->radio('isUse', __('是否使用'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->text('fromTable', __('来自表'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('ownId', __('所属ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('dataFlag', __('删除标志'))->options(['1' => '删除','0' => '有效'])
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('图像信息表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('图像信息表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Images());
        return $content
            ->header('图像信息表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Images::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('fromType', __('来自类型'));
        $show->field('dataId', __('数据ID'));
        $show->field('imgPath', __('图像路径'));
        $show->field('imgSize', __('图像大小'));
        $show->field('isUse', __('是否使用'));
        $show->field('createTime', __('创建时间'));
        $show->field('fromTable', __('来自表'));
        $show->field('ownId', __('所属ID'));
        $show->field('dataFlag', __('删除标志'));
        return $show;
        }
}
