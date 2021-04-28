<?php

namespace App\Admin\Controllers;

use App\Models\LogSms;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class LogSmsController extends AdminController
{
    protected $title = "短信发送记录表";

    public function index(Content $content)
    {
        return $content
            ->header('短信发送记录表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new LogSms());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('smsSrc', __('消息类型'));
                $grid->column('smsUserId', __('发送者ID'));
                $grid->column('smsPhoneNumber', __('短信号码'));
                $grid->column('smsReturnCode', __('短信返回值'));
                $grid->column('smsIP', 'IP地址');
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new LogSms());
                $form->radio('smsSrc', __('消息类型'))->options(['1' => '扩展','0' => '系统消息'])
                ->rules('required');
                $form->number('smsUserId', __('发送者ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('smsContent', __('短信内容'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('smsPhoneNumber', __('短信号码'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('smsReturnCode', __('短信返回值'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('smsCode', __('短信中的验证码'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('smsFunc', __('调用短信的接口'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->ip('smsIP', __('IP地址'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('短信发送记录表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('短信发送记录表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new LogSms());
        return $content
            ->header('短信发送记录表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(LogSms::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('smsSrc', __('消息类型'));
        $show->field('smsUserId', __('发送者ID'));
        $show->field('smsContent', __('短信内容'));
        $show->field('smsPhoneNumber', __('短信号码'));
        $show->field('smsReturnCode', __('短信返回值'));
        $show->field('smsCode', __('短信中的验证码'));
        $show->field('smsFunc', __('调用短信的接口'));
        $show->field('smsIP', __('IP地址'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
