<?php

namespace App\Admin\Controllers;

use App\Models\LogUserLogins;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class LogUserLoginsController extends AdminController
{
    protected $title = "用户登录记录表";

    public function index(Content $content)
    {
        return $content
            ->header('用户登录记录表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new LogUserLogins());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('userId', __('帐户ID'));
                $grid->column('loginTime', __('登录时间'));
                $grid->column('loginIp', __('登录IP'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form() { 
            $form = new Form(new LogUserLogins());
            $form->text('userId', __('职员ID'))
            ->creationRules('required|max:200|unique:log_user_logins', 
                ['required'=> '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
            $form->datetime('loginTime', __('登录时间'))
                ->creationRules('required', ['required' => '此项不能为空']); 
            $form->ip('loginIp', __('登录IP'))
                ->creationRules('required|max:200',
                    ['required' => '此项不能为空','max' =>'不能大于200个字符']);
            $form->radio('loginSrc', __('登录来源'))->options(['0' =>'PC','1' => 'webapp','2' => 'App','3' => '微信','4' => 'IOS'])
                ->rules('required');
            $form->textarea('loginRemark', __('登录备注'))
                ->creationRules('required|max:200',
                ['required' => '此项不能为空','max' =>'不能大于200个字符']); 
            return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('用户登录记录表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('用户登录记录表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new LogUserLogins());
        return $content
            ->header('用户登录记录表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(LogUserLogins::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('userId', __('职员ID'));
        $show->field('loginTime', __('登录时间'));
        $show->field('loginIp', __('登录IP'));
        $show->field('loginSrc', __('登录来源'));
        $show->field('loginRemark', __('登录备注'));
        return $show;
        }
}
