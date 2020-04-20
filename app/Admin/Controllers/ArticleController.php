<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Welfare;
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
        /*$grid->column('content', __('活动内容'))->display(function ($content){
            return $content;
        });*/
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

        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('title', '标题');
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

        $form->tools(function (Form\Tools $tools) {
            // 去掉`列表`按钮
//            $tools->disableList();
            // 去掉`删除`按钮
//            $tools->disableDelete();
            // 去掉`查看`按钮
            $tools->disableView();

        });

        $form->datetime('start_at', __('活动开始时间'))->default(date('Y-m-d H:i:s'));
        $form->datetime('end_at', __('活动结束时间'))->default(date('Y-m-d H:i:s'));
        $form->select('wid', '活动商品')->options(Welfare::where(['type_id' => 4])->pluck('name','id'));
        $form->embeds('conditions', '参与活动所需条件', function ($form) {

            $form->radio('is_card', '是否使用福利卡')->options([0 => '不使用', 1 => '使用']);
            $form->number('yidudian_gt', '易读点大于')->min(0);
            $form->number('yidudian_lt', '易读点小于')->min(0);
            $form->number('integral_gt', '积分大于')->min(0);
            $form->number('integral_lt', '积分小于')->min(0);
        });
        $form->text('title', __('活动标题'));
        $form->editor('content', __('活动内容'));


        $form->footer(function ($footer) {

            // 去掉`重置`按钮
            //$footer->disableReset();

            // 去掉`提交`按钮
            //$footer->disableSubmit();

            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            //$footer->disableEditingCheck();

            // 去掉`继续创建`checkbox
            //$footer->disableCreatingCheck();

        });
        return $form;
    }
}
