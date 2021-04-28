<?php

namespace App\Admin\Controllers;

use App\Models\Ads;
use App\Models\AdPositions;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class AdsController extends AdminController
{
    protected $title = "广告列表";

    public function index(Content $content)
    {
        return $content
            ->header('广告列表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Ads());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('positionName', __('广告位置ID'))->display(function (){
                    return $this->AdPositions['positionName'];});
                $grid->column('adName', __('广告名称'));
                $grid->column('adURL', __('广告URL'));
                $grid->column('adStartDate', __('广告开始日期'));
                $grid->column('adEndDate', __('广告结束日期'));
                $grid->column('adClickNum', '广告单击次数');
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Ads());
                $form->select('adPositionId', __('广告位置ID'))
                ->options(AdPositions::pluck('positionName','id'))
                ->creationRules('required|max:200|unique:ads',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('adFile', __('广告文件'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('adName', __('广告名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->url('adURL', __('广告URL'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->date('adStartDate', __('广告开始日期'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->date('adEndDate', __('广告结束日期'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->number('adSort', __('排序'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('adClickNum', __('广告单击次数'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('positionType', __('位置类型'))->options(['1' => '电脑前端','0' => '手机前端'])
                ->rules('required');
                $form->radio('dataFlag', __('数据标识'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);

                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('广告列表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('广告列表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Ads());
        return $content
            ->header('广告列表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Ads::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('positionName', __('广告位置ID'))->as(function ($AdPositions) {
                return $this->AdPositions['positionName'];
            });
        $show->field('adFile', __('广告文件'));
        $show->field('adName', __('广告名称'));
        $show->field('adURL', __('广告URL'));
        $show->field('adStartDate', __('广告开始日期'));
        $show->field('adEndDate', __('广告结束日期'));
        $show->field('adSort', __('排序'));
        $show->field('adClickNum', __('广告单击次数'));
        $show->field('positionType', __('位置类型'));
        $show->field('positionType', __('位置类型'))->as(function($positionType) {
            if($positionType == 1) {
                $positionType='电脑前端';
            }else {
                $positionType='手机前端';
            }
            return $positionType;
        });
        $show->field('dataFlag', __('数据标识'))->as(function($dataFlag) {
            if($dataFlag == 1) {
                $dataFlag='是';
            }else {
                $dataFlag='否';
            }
            return $dataFlag;
        });
        $show->field('createTime', __('创建时间'));
        
        return $show;
        }
}
