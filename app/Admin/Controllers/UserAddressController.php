<?php

namespace App\Admin\Controllers;

use App\Models\Areas;
use App\Models\UserAddress;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class UserAddressController extends AdminController
{
    protected $title = "用户收货地址表";

    public function index(Content $content)
    {
        return $content
            ->header('用户收货地址表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new UserAddress());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('userName', __('收货人名称'));
                $grid->column('areaIdPath', __('区域ID路径'));
                $grid->column('dataFlag', __('有效状态'));
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new UserAddress());
                $form->text('userId', __('会员ID'))
                ->creationRules('required|max:200|unique:user_address',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('userName', __('收货人名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('userPhone', __('收货人手机号码'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('areaIdPath', __('区域ID路径'))
                ->rules('required');
                $form->select('areaId', __('最后一级区域ID'))
                ->options(Areas::pluck('areaName','id'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->textarea('userAddress', __('详细地址'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isDefault', __('是否默认地址'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->radio('dataFlag', __('有效状态'))->options(['1' => '有效','0' => '无效'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('用户收货地址表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('用户收货地址表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new UserAddress());
        return $content
            ->header('用户收货地址表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(UserAddress::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('userId', __('会员ID'));
        $show->field('userName', __('收货人名称'));
        $show->field('userPhone', __('收货人手机号码'));
        $show->field('areaIdPath', __('区域ID路径'));
        $show->field('areaId', __('最后一级区域ID'));
        $show->field('userAddress', __('详细地址'));
        $show->field('isDefault', __('是否默认地址'));
        $show->field('dataFlag', __('有效状态'));
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
