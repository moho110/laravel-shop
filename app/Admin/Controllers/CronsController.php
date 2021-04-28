<?php

namespace App\Admin\Controllers;

use App\Models\Crons;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class CronsController extends AdminController
{
    protected $title = "定时任务表";

    public function index(Content $content)
    {
        return $content
            ->header('定时任务表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Crons());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('cronName', __('定时任务名称'));
                $grid->column('cronCode', __('定时任务代码'));
                $grid->column('cronUrl', __('定时任务URL'));
                $grid->column('author', __('计划任务作者'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Crons());
                $form->text('cronName', __('定时任务名称'))
                ->creationRules('required|max:200|unique:crons',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('cronCode', __('定时任务代码'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isEnable', __('是否启用'))->options(['1' => '启用','0' => '停用'])
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isRunning', __('是否正在运行'))->options(['1' => '运行中','0' => '未运行'])
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->textarea('cronJson', __('定时任务json'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('cronUrl', __('定时任务URL'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('cronDesc', __('定时任务描述'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('cronCycle', __('执行周期'))->options(['0' => '每月','1' => '每周','2' => '每日'])
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('cronDay', __('执行日期'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('cronWeek', __('执行周'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('cronHour', __('执行小时'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('cronMinute', __('执行分钟'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('runTime', __('当前执行时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->text('nextTime', __('下次执行时间'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isRunSuccess', __('上次是否运行成功'))->options(['1' => '成功','0' => '失败'])
                ->rules('required');
                $form->text('author', __('计划任务作者'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('authorUrl', __('计划任务作者网址'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('定时任务表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('定时任务表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Crons());
        return $content
            ->header('定时任务表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Crons::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('cronName', __('定时任务名称'));
        $show->field('cronCode', __('定时任务代码'));
        $show->field('isEnable', __('是否启用'));
        $show->field('isRunning', __('是否正在运行'));
        $show->field('cronJson', __('定时任务json'));
        $show->field('cronUrl', __('定时任务URL'));
        $show->field('cronDesc', __('定时任务描述'));
        $show->field('cronCycle', __('执行周期'));
        $show->field('cronDay', __('执行日期'));
        $show->field('cronWeek', __('执行周'));
        $show->field('cronHour', __('执行小时'));
        $show->field('cronMinute', __('执行分钟'));
        $show->field('runTime', __('当前执行时间'));
        $show->field('nextTime', __('下次执行时间'));
        $show->field('isRunSuccess', __('上次是否运行成功'));
        $show->field('author', __('计划任务作者'));
        $show->field('authorUrl', __('计划任务作者网址'));
        return $show;
        }
}
