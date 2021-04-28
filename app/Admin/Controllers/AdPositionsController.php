<?php

namespace App\Admin\Controllers;

use App\Models\AdPositions;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class AdPositionsController extends AdminController
{
    protected $title = "广告位置";

    public function index(Content $content)
    {
        return $content
            ->header('广告位置')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new AdPositions());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('positionName', __('广告位置名称'));
                $grid->column('positionWidth', __('广告位置宽'));
                $grid->column('positionHeight', __('广告位置长'));
                $grid->column('positionCode', __('位置代码'));
                $grid->column('dataFlag', '数据标识')
                    ->display(function ($dataFlag) {
                        return $dataFlag ? '<span style="color:green;">是</span>' : '<span style="color:red;">是</span>';
                    });
                $grid->column('apSort', __('位置排序'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new AdPositions());
                $form->radio('positionType', __('广告位置类型'))->options(['1' => '电脑前端','0' => '手机前端'])
                ->rules('required');
                $form->text('positionName', __('广告位置名称'))
                ->creationRules('required|max:200|unique:ad_positions',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('positionWidth', __('广告位置宽'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('positionHeight', __('广告位置长'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('dataFlag', __('数据标识'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->text('positionCode', __('位置代码'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('apSort', __('排序'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('广告位置');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('广告位置')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new AdPositions());
        return $content
            ->header('广告位置')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(AdPositions::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('positionType', __('广告位置类型'))->as(function($positionType) {
            if($positionType == 1) {
                $positionType='电脑前端';
            }else {
                $positionType='手机前端';
            }
            return $positionType;
        });
        $show->field('positionName', __('广告位置名称'));
        $show->field('positionWidth', __('广告位置宽'));
        $show->field('positionHeight', __('广告位置长'));
        $show->field('dataFlag', __('数据标识'))->as(function($dataFlag) {
            if($dataFlag == 1) {
                $dataFlag='已处理';
            }else {
                $dataFlag='未处理';
            }
            return $dataFlag;
        });
        $show->field('positionCode', __('位置代码'));
        $show->field('apSort', __('位置排序'));
        return $show;
        }
}
