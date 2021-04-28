<?php

namespace App\Admin\Controllers;

use App\Models\Attributes;
use App\Models\GoodsCats;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Facades\Admin;

class AttributesController extends AdminController
{
    protected $title = "属性列表";

    public function index(Content $content)
    {
        return $content
            ->header('属性列表')
            ->description('列表')
            ->body($this->grid());
    }

    
    protected function grid() {
                $grid = new Grid(new Attributes());
                $grid->column('id', __('编号'))->sortable();
                $grid->column('catName', __('商品分类ID'))->display(function (){
                    return $this->GoodsCats['catName'];});
                $grid->column('attrName', __('属性名称'));
                $grid->column('attrVal', __('属性值'));
                $grid->column('isShow', '是否显示')
                    ->display(function ($isShow) {
                        return $isShow ? '<span style="color:green;">是</span>' : '<span style="color:red;">是</span>';
                    });
                $grid->column('dataFlag', '删除标志')
                    ->display(function ($dataFlag) {
                        return $dataFlag ? '<span style="color:green;">删除</span>' : '<span style="color:red;">有效</span>';
                    });
                $grid->column('createTime', __('创建时间'));

                $grid->paginate(10);

                return $grid;
        }

        protected function form()
        {
                $form = new Form(new Attributes());
                $form->select('goodsCatId', __('商品分类ID'))
                ->options(GoodsCats::pluck('catName','id'))
                ->creationRules('required|max:200|unique:attributes',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符','unique' => '数据已经存在']);
                $form->text('goodsCatPath', __('商品分类路径'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->text('attrName', __('属性名称'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('attrType', __('属性类型'))->options(['1' => '输入框','2' => '多选项','3' => '下拉框'])
                ->rules('required');
                $form->text('attrVal', __('属性值'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->number('attrSort', __('属性排序'))
                ->creationRules('required|max:200',
                        ['required' => '此项不能为空','max' =>'不能大于200个字符']);
                $form->radio('isShow', __('是否显示'))->options(['1' => '是','0' => '否'])
                ->rules('required');
                $form->radio('dataFlag', __('删除标志'))->options(['1' => '删除','0' => '有效'])
                ->rules('required');
                $form->datetime('createTime', __('创建时间'))
                ->creationRules('required',
                        ['required' => '此项不能为空']);
                return $form;
        }

        public function create(Content $content) {
        return Admin::content(function (Content $content) {
            $content->header('属性列表');
            $content->description('新增');
            $content->body($this->form());
            });
        }

        public function show($id, Content $content)
        {
        return $content
            ->header('属性列表')
            ->description('详情')
            ->body($this->detail($id));
        }

        public function edit($id, Content $content)
        {
            $form = new Form(new Attributes());
        return $content
            ->header('属性列表')
            ->description('编辑')
            ->body($this->form()->edit($id));
        }

        protected function detail($id)
        {
        $show = new Show(Attributes::findOrFail($id));

        $show->field('id', __('编号'));
        $show->field('catName', __('商品分类ID'))->as(function ($GoodsCats) {
                return $this->GoodsCats['catName'];
            });
        $show->field('goodsCatPath', __('商品分类路径'));
        $show->field('attrName', __('属性名称'));
        $show->field('attrType', __('属性类型'))->as(function($attrType) {
            if($attrType == 1) {
                $attrType='输入框';
            }else if($attrType == 2) {
                $attrType='多选项';
            } else {
                $attrType='下拉框';
            }
            return $attrType;
        });
        $show->field('attrVal', __('属性值'));
        $show->field('attrSort', __('属性排序'));
        $show->field('isShow', __('是否显示'))->as(function($isShow) {
            if($isShow == 1) {
                $isShow='是';
            }else {
                $isShow='否';
            }
            return $isShow;
        });
        $show->field('dataFlag', __('删除标志'))->as(function($dataFlag) {
            if($dataFlag == 1) {
                $dataFlag='删除';
            }else {
                $dataFlag='有效';
            }
            return $dataFlag;
        });
        $show->field('createTime', __('创建时间'));
        return $show;
        }
}
