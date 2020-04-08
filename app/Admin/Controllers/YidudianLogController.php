<?php

namespace App\Admin\Controllers;

use App\Models\Member;
use App\Models\YidudianLog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class YidudianLogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '易读点记录';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new YidudianLog());

        $grid->column('id', __('Id'));
//        $grid->column('mid', __('会员id'));
        $grid->column('member.nickname', '会员昵称');
        $grid->column('title', __('标题'));
        $grid->column('yidudian', __('易读点'));
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
//            $filter->with(['member'=>function($query){
//                $query->where('nickname', 'like', "%{$this->input}%");
//            }]);
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
        $show = new Show(YidudianLog::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('mid', __('会员id'));
        $show->field('title', __('标题'));
        $show->field('yidudian', __('易读点'));
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
        $form = new Form(new YidudianLog());

        $form->number('mid', __('会员id'));
        $form->text('title', __('标题'));
        $form->currency('yidudian', __('易读点'))->default(0.00);

        return $form;
    }
}
