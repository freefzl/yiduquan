<?php

namespace App\Admin\Controllers;

use App\Models\Welfare;
use App\Models\WelfareType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WelfareController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '福利中心';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new Welfare());

        $grid->column('id', __('Id'));
        $grid->column('image', __('商品图片'))->display(function ($image) {
            return "<img style='width: 50px;' src=".env('IMG_URL').$image.">";
        });
        $grid->column('type_id', __('商品类型'))->display(function ($type_id) {
            return WelfareType::find($type_id)->cate_name;
        });
        $grid->column('name', __('商品名称'));
        $grid->column('inventory', __('库存(件)'));
        $grid->column('postage', __('邮费说明'));
        $grid->column('price', __('兑换价(易读点)'));
        $grid->column('cash', __('现金'));
        $grid->column('created_at', __('生成时间'));
        $grid->column('updated_at', __('修改时间'));

        $states = [
            'on'  => ['value' => 1, 'text' => '上架', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '下架', 'color' => 'default'],
        ];
        $grid->column('status', '是否上架')->switch($states);

        $grid->actions(function ($actions) {

            // 去掉删除
            //$actions->disableDelete();

            // 去掉编辑
//            $actions->disableEdit();

            // 去掉查看
            $actions->disableView();
        });

        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('name', '商品名称');
            $filter->between('created_at', '生成时间')->datetime();

        });

        return $grid;
    }


    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Welfare::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('image', __('Image'));
        $show->field('content', __('Content'));
        $show->field('type_id', __('Type id'));
        $show->field('name', __('Name'));
        $show->field('inventory', __('Inventory'));
        $show->field('postage', __('Postage'));
        $show->field('price', __('Price'));
        $show->field('cash', __('cash'));
        $show->field('process', __('Process'));
        $show->field('attention', __('Attention'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Welfare());

        $form->select('type_id', __('商品分类'))->options(WelfareType::all()->pluck('cate_name','id'))->rules('required',['required' => '商品分类是必须的']);
        $form->image('image', __('商品封面图'))->rules('required',['required' => '商品封面图是必须的']);
        $form->editor('content', '商品详情')->rules('required',['required' => '商品详情是必须的']);
        $form->text('name', __('商品名称'))->rules('required',['required' => '商品名称是必须的']);
        $form->number('inventory', __('库存'))->rules('required|integer',['required' => '库存是必须的', 'integer' => '库存必须是整数']);
        $form->text('postage', __('邮费说明'))->rules('required',['required' => '邮费说明是必须的']);
        $form->currency('price', __('兑换价'))->rules('required',['required' => '兑换价是必须的']);
        $form->currency('cash', __('现金'))->rules('required',['required' => '兑换价是必须的']);
        $form->editor('process', __('兑换流程'))->rules('required',['required' => '兑换流程是必须的']);
        $form->editor('attention', __('注意事项'))->rules('required',['required' => '注意事项是必须的']);

        $states = [
            'on'  => ['value' => 1, 'text' => '上架', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '下架', 'color' => 'danger'],
        ];

        $form->switch('status', '是否上架')->states($states);
        return $form;
    }
}
