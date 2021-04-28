<?php

namespace App\Admin\Controllers;

use App\Models\Messages;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class MessagesController extends AdminController
{
    protected $title = "商城信息表";

    public function index(Content $content)
    {
        return $content
            ->header('商城信息表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Messages());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('msgType', __('消息类型'));
                $grid->column('sendUserId', __('发送者ID'));
                $grid->column('receiveUserId', __('接收者ID'));
                $grid->column('msgStatus', __('阅读状态'));
                $grid->column('createTime', '发送时间');

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Messages());
                $form->text('msgType', __('消息类型'))->options(['1' => '系统自动发的消息','0' => '手工发送的消息'])
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('sendUserId', __('发送者ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('receiveUserId', __('接收者ID'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('msgContent', __('消息内容'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('msgStatus', __('阅读状态'))->options(['1' => '已读','0' => '未读'])
                ->rules('required');
                $form->radio('msgJson', __('存放json数据'))->options(['0' => '普通消息','1' => '订单','2' => '商品','3' => '订单投诉','4' => '结算信息','5' => '提现申请','6' => '商品评价'])
                ->rules('required');
                $form->radio('dataFlag', __('有效状态'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->datetime('createTime', __('发送时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('商城信息表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('商城信息表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Messages());
        return $content
            ->header('商城信息表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Messages::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('msgType', __('消息类型'));
        $show->field('sendUserId', __('发送者ID'));
        $show->field('receiveUserId', __('接收者ID'));
        $show->field('msgContent', __('消息内容'));
        $show->field('msgStatus', __('阅读状态'));
        $show->field('msgJson', __('存放json数据'));
        $show->field('dataFlag', __('存放json数据'));
        $show->field('createTime', __('发送时间'));
        return $show;
        }
}
