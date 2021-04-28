<?php

namespace App\Admin\Controllers;

use App\Models\Articles;
use App\Models\ArticleCats;
use App\Models\Staffs;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class ArticlesController extends AdminController
{
    protected $title = "文章列表";

    public function index(Content $content)
    {
        return $content
            ->header('文章列表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Articles());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('catId', __('分类ID'));
                $grid->column('articleTitle', __('文章标题'));
                $grid->column('isShow', __('是否显示'));
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Articles());
                $form->select('catId', __('分类ID'))->options(ArticleCats::selectOptions());
                $form->text('articleTitle', __('文章标题'))
                ->creationRules('required|max:200|unique:articles',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->radio('isShow', __('是否显示'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->textarea('articleContent', __('文章内容'))
                ->creationRules('required|max:255',
                        ['required' => '此项不能为空','max' =>'不能大于255个字符']);
                $form->text('articleKey', __('文章SEO关键字'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->select('staffId', __('创建者'))
                ->options(Staffs::pluck('loginName','id'))
                ->rules('required');
                $form->radio('dataFlag', __('删除标志'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                $form->radio('solve', __('觉得文章有帮助的次数'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->radio('unsolve', __('觉得文章没帮助的次数'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('文章列表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('文章列表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Articles());
        return $content
            ->header('文章列表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Articles::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('catId', __('分类ID'));
        $show->field('articleTitle', __('文章标题'));
        $show->field('isShow', __('是否显示'))->as(function($isShow) {
            if($isShow == 1) {
                $isShow='是';
            }else {
                $isShow='否';
            }
            return $isShow;
        });
        $show->field('articleContent', __('文章内容'));
        $show->field('articleKey', __('文章SEO关键字'));
        $show->field('staffId', __('创建者'));
        $show->field('dataFlag', __('删除标志'));
        $show->field('dataFlag', __('删除标志'))->as(function($dataFlag) {
            if($dataFlag == 1) {
                $dataFlag='删除';
            }else {
                $dataFlag='有效';
            }
            return $dataFlag;
        });
        $show->field('createTime', __('创建时间'));
        $show->field('solve', __('觉得文章有帮助的次数'))->as(function($solve) {
            if($solve == 1) {
                $solve='是';
            }else {
                $solve='否';
            }
            return $solve;
        });
        $show->field('unsolve', __('觉得文章没帮助的次数'))->as(function($unsolve) {
            if($unsolve == 1) {
                $unsolve='是';
            }else {
                $unsolve='否';
            }
            return $unsolve;
        });
        return $show;
        }
}
