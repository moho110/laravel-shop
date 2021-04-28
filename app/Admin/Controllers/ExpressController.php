<?php

namespace App\Admin\Controllers;

use App\Models\Express;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class ExpressController extends AdminController
{
    protected $title = "快递信息表";

    public function index(Content $content)
    {
        return $content
            ->header('快递信息表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Express());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('expressName', __('快递名称'));
                $grid->column('dataFlag', '删除标志')
                    ->display(function ($dataFlag) {
                        return $dataFlag ? '<span style="color:green;">是</span>' : '<span style="color:red;">是</span>';
                    });

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Express());
                $form->text('expressName', __('快递名称'))
                ->creationRules('required|max:200|unique:express',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->radio('dataFlag', __('删除标志'))->options(['1' => '删除','0' => '有效'])
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('快递信息表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('快递信息表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Express());
        return $content
            ->header('快递信息表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Express::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('expressName', __('快递名称'));
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
