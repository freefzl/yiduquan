<?php

namespace App\Admin\Controllers;

use App\Models\IntegralLog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class IntegralLogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '积分记录';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new IntegralLog());

        $grid->column('id', __('Id'));
        $grid->column('member.nickname', __('会员昵称'));
        $grid->column('title', __('标题'));
        $grid->column('integral', __('积分'));
        $grid->column('created_at', __('生成时间'));
        $grid->column('updated_at', __('修改时间'));
        $grid->actions(function ($actions) {
            // 去掉删除
            //$actions->disableDelete();
            // 去掉编辑
            $actions->disableEdit();
            // 去掉查看
//            $actions->disableView();
        });

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            $filter->like('member.nickname', '会员昵称');
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
        $show = new Show(IntegralLog::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('mid', __('Mid'));
        $show->field('title', __('Title'));
        $show->field('integral', __('Integral'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new IntegralLog());

        $form->number('mid', __('Mid'));
        $form->text('title', __('Title'));
        $form->currency('integral', __('Integral'))->default(0.00);
        $form->switch('status', __('Status'))->default(1);

        return $form;
    }
}
