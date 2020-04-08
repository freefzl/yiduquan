<?php

namespace App\Admin\Controllers;

use App\Models\Voucher;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VoucherController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '兑换券';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Voucher());

        $grid->disableCreateButton();

        $grid->column('id', __('Id'));
        $grid->column('member.nickname', __('会员昵称'));
        $grid->column('welfare.name', __('商品名称'));
        $grid->column('type', __('获取类型'))->display(function($type) {
            if ($type == 1) {
                return '系统赠予';
            }else if ($type == 2) {
                return '积分兑换';
            }
        });
        $grid->column('status', __('状态'))->display(function($status){
            if ($status == 0) {
                return '未使用';
            }else if ($status == 1) {
                return '已使用';
            } else if ($status == 2) {
                return '已过期';
            }
        });
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
            $filter->like('member.nickname', '会员昵称');
            $filter->like('welfare.name', '商品名称');
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
        $show = new Show(Voucher::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
//                $tools->disableList();
//                $tools->disableDelete();
            });

        $show->field('id', __('Id'));
        $show->field('member.nickname', __('会员昵称'));
        $show->field('welfare.name', __('商品名称'));
        $show->field('type', __('获取类型'));
        $show->field('status', __('状态'));
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
        $form = new Form(new Voucher());

        $form->number('mid', __('Mid'));
        $form->number('wid', __('Wid'));
        $form->switch('status', __('Status'));

        return $form;
    }
}
