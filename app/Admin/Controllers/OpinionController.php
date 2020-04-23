<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Exporters\OpinionExporter;
use App\Models\Opinion;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OpinionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '意见反馈';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Opinion());

        $grid->disableActions();

        $grid->column('id', __('Id'));
        $grid->column('member.nickname', __('会员昵称'));
        $grid->column('content', __('意见内容'));
        $grid->column('created_at', __('生成时间'));
        $grid->column('updated_at', __('修改时间'));

        $grid->disableCreateButton();

        $grid->actions(function ($actions) {

            // 去掉删除
            $actions->disableDelete();

            // 去掉编辑
            $actions->disableEdit();

            // 去掉查看
            $actions->disableView();
        });

        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('content', '意见内容');
            $filter->between('created_at', '生成时间')->datetime();

        });

        $grid->exporter(new OpinionExporter());

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
        $show = new Show(Opinion::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('content', __('Content'));
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
        $form = new Form(new Opinion());

        $form->textarea('content', __('Content'));

        return $form;
    }
}
