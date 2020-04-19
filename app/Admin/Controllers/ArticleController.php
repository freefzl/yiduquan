<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '平台活动';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());

        $grid->column('id', __('Id'));
        $grid->column('start_at', __('开始时间'));
        $grid->column('end_at', __('结束时间'));
        $grid->column('title', __('标题'));
        $grid->column('content', __('活动内容'))->display(function ($content){
            return $content;
        });
        $grid->column('created_at', __('生成时间'));
//        $grid->column('updated_at', __('修改时间'));

        $grid->actions(function ($actions) {

            // 去掉删除
            //$actions->disableDelete();

            // 去掉编辑
//            $actions->disableEdit();

            // 去掉查看
            $actions->disableView();
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
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('start_at', __('Start at'));
        $show->field('end_at', __('End at'));
        $show->field('title', __('Title'));
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
        $form = new Form(new Article());

        $form->datetime('start_at', __('活动开始时间'))->default(date('Y-m-d H:i:s'));
        $form->datetime('end_at', __('活动结束时间'))->default(date('Y-m-d H:i:s'));
        $form->text('title', __('活动标题'));
        $form->editor('content', __('活动内容'));


        return $form;
    }
}
