<?php

namespace App\Admin\Controllers;

use App\Models\Address;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AddressController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '会员地址';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Address());

        $grid->disableCreateButton();

        $grid->column('id', __('Id'));
        $grid->column('member.nickname', __('会员昵称'));
        $grid->column('name', __('名称'));
        $grid->column('mobile', __('手机号'));
        $grid->column('province', __('省'));
        $grid->column('city', __('市'));
        $grid->column('area', __('区'));
        $grid->column('address', __('详情地址'));
        $grid->column('default', __('默认地址'));
        $grid->column('status', __('状态'));
        $grid->column('created_at', __('生成时间'));
        $grid->column('updated_at', __('修改时间'));

        $grid->actions(function ($actions) {
            // 去掉删除
            $actions->disableDelete();
            // 去掉编辑
            $actions->disableEdit();
            // 去掉查看
            //$actions->disableView();
        });

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('member.nickname', '商品名称');
            $filter->like('address', '详情地址');
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
        $show = new Show(Address::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member.nickname', __('会员昵称'));
        $show->field('name', __('名称'));
        $show->field('mobile', __('手机号'));
        $show->field('province', __('省'));
        $show->field('city', __('市'));
        $show->field('area', __('区'));
        $show->field('address', __('详情地址'));
        $show->field('default', __('默认地址'));
        $show->field('status', __('状态'));
        $show->field('created_at', __('生成时间'));
        $show->field('updated_at', __('修改时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Address());

        $form->number('mid', __('Mid'));
        $form->text('name', __('Name'));
        $form->mobile('mobile', __('Mobile'));
        $form->text('province', __('Province'));
        $form->text('city', __('City'));
        $form->text('area', __('Area'));
        $form->text('address', __('Address'));
        $form->switch('default', __('Default'));
        $form->switch('status', __('Status'))->default(1);

        return $form;
    }
}
