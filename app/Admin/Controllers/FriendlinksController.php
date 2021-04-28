<?php

namespace App\Admin\Controllers;

use App\Models\Friendlinks;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class FriendlinksController extends AdminController
{
    protected $title = "友情链接表";

    public function index(Content $content)
    {
        return $content
            ->header('友情链接表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Friendlinks());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('friendlinkIco', __('图标'));
                $grid->column('friendlinkName', __('名称'));
                $grid->column('friendlinkUrl', __('网址'));
                $grid->column('friendlinkSort', __('排序号'));
                $grid->column('dataFlag', '删除标志');
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Friendlinks());
                $form->icon('friendlinkIco', __('图标'))
                ->rules('required');
                $form->text('friendlinkName', __('名称'))
                ->creationRules('required|max:200|unique:friendlinks',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->url('friendlinkUrl', __('网址'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('friendlinkSort', __('排序号'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('dataFlag', __('删除标志'))->options(['1' => '删除','0' => '有效'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required', ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('友情链接表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('友情链接表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Friendlinks());
        return $content
            ->header('友情链接表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Friendlinks::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('friendlinkIco', __('图标'));
        $show->field('friendlinkName', __('名称'));
        $show->field('friendlinkUrl', __('网址'));
        $show->field('friendlinkSort', __('排序号'));
        $show->field('dataFlag', __('删除标志'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
