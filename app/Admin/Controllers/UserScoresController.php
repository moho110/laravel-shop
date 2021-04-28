<?php

namespace App\Admin\Controllers;

use App\Models\Datas;
use App\Models\UserScores;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class UserScoresController extends AdminController
{
    protected $title = "用户积分表";

    public function index(Content $content)
    {
        return $content
            ->header('用户积分表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new UserScores());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('userId', __('用户ID'));
                $grid->column('score', __('积分数'));
                $grid->column('dataSrc', __('来源'));
                $grid->column('dataId', __('来源记录ID'));
                $grid->column('scoreType', '积分标识');
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new UserScores());
                $form->text('userId', __('用户ID'))
                ->creationRules('required|max:200|unique:cmf_bank',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('score', __('积分数'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('dataSrc', __('来源'))->options(['1' => '订单','2' => '评价','3' => '订单取消返还','4' => '拒收返还'])
                ->rules('required');
                $form->select('dataId', __('来源记录ID'))
                ->options(Datas::pluck('dataName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('dataRemarks', __('描述'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('scoreType', __('积分标识'))->options(['1' => '收入','2' => '支出'])
                ->rules('required');
                 $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('用户积分表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('用户积分表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new UserScores());
        return $content
            ->header('用户积分表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(UserScores::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('userId', __('用户ID'));
        $show->field('score', __('积分数'));
        $show->field('dataSrc', __('来源'));
        $show->field('dataId', __('来源记录ID'));
        $show->field('dataRemarks', __('描述'));
        $show->field('scoreType', __('积分标识'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
