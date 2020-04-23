<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Exporters\FriendsExporter;
use App\Models\Friends;
use App\Repositories\Members\FriendsRepository;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class FriendsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '好友';



    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Friends());

        $grid->disableCreateButton();
        $grid->disableActions();

        $grid->column('id', __('Id'));
        $grid->column('member.nickname', __('会员昵称'));
        $grid->column('friend.nickname', __('好友昵称'));
        $grid->column('created_at', __('生成时间'));
//        $grid->column('updated_at', __('修改时间'));

        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('member.nickname', '会员昵称');
            $filter->like('friend.nickname', '好友昵称');
            $filter->between('created_at', '生成时间')->datetime();


        });


        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        $grid->exporter(new FriendsExporter());

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
        $show = new Show(Friends::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('mid', __('Mid'));
        $show->field('fid', __('Fid'));
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
        $form = new Form(new Friends());

        $form->number('mid', __('Mid'));
        $form->number('fid', __('Fid'));

        return $form;
    }
}
