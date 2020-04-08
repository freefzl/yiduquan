<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->disableCreateButton();

        $grid->column('id', __('Id'));
        $grid->column('no', __('订单流水号'));
        $grid->column('member.nickname', __('买家'));
//        $grid->column('address', __('JSON 格式的收货地址'));
        $grid->column('total_amount', __('总金额'));
//        $grid->column('remark', __('订单备注'));
        $grid->column('paid_at', __('支付时间'));
//        $grid->column('payment_method', __('支付方式'));
//        $grid->column('payment_no', __('支付平台订单号'));
        $grid->column('refund_status', __('退款状态'));
//        $grid->column('refund_no', __('退款流水号'));
//        $grid->column('closed', __('订单是否已关闭'));
//        $grid->column('reviewed', __('订单是否已评价'));
        $grid->column('ship_status', __('物流状态'));
//        $grid->column('ship_data', __('物流数据'));
//        $grid->column('extra', __('其他额外的数据'));
//        $grid->column('created_at', __('生成时间'));
//        $grid->column('updated_at', __('修改时间'));

        $grid->actions(function ($actions) {
            // 去掉删除
            $actions->disableDelete();
            // 去掉编辑
            $actions->disableEdit();
            // 去掉查看
            //$actions->disableView();
        });

        return $grid;
    }

    /*public function show($id, Content $content)
    {
        return $content
            ->header('查看订单')
            // body 方法可以接受 Laravel 的视图作为参数
            ->body(view('admin.orders.show', ['order' => Order::find($id)]));
    }*/

    public function show($id, Content $content)
    {
        return $content
            ->header('查看订单')
//            ->body($this->detail($id));
            ->body(view('admin.orders.show', ['order' => Order::find($id)]));
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('no', __('订单流水号'));
        $show->field('mid', __('买家'));
        $show->field('address', __('JSON 格式的收货地址'));
        $show->field('total_amount', __('总金额'));
        $show->field('remark', __('订单备注'));
        $show->field('paid_at', __('支付时间'));
        $show->field('payment_method', __('支付方式'));
        $show->field('payment_no', __('支付平台订单号'));
        $show->field('refund_status', __('退款状态'));
        $show->field('refund_no', __('退款流水号'));
        $show->field('closed', __('订单是否已关闭'));
        $show->field('reviewed', __('订单是否已评价'));
        $show->field('ship_status', __('物流状态'));
        $show->field('ship_data', __('物流数据'));
        $show->field('extra', __('其他额外的数据'));
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
        $form = new Form(new Order());

        $form->text('no', __('No'));
        $form->number('mid', __('Mid'));
        $form->textarea('address', __('Address'));
        $form->decimal('total_amount', __('Total amount'));
        $form->textarea('remark', __('Remark'));
        $form->datetime('paid_at', __('Paid at'))->default(date('Y-m-d H:i:s'));
        $form->text('payment_method', __('Payment method'));
        $form->text('payment_no', __('Payment no'));
        $form->text('refund_status', __('Refund status'));
        $form->text('refund_no', __('Refund no'));
        $form->switch('closed', __('Closed'));
        $form->switch('reviewed', __('Reviewed'));
        $form->text('ship_status', __('Ship status'));
        $form->textarea('ship_data', __('Ship data'));
        $form->textarea('extra', __('Extra'));

        return $form;
    }
}
