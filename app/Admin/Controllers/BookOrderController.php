<?php

namespace App\Admin\Controllers;

use App\Models\BookOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BookOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '图书订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BookOrder());
        $grid->disableCreateButton();


        $grid->column('id', __('Id'));
        $grid->column('no', __('订单号'));
        $grid->column('buyMember.nickname', __('买家'));
        $grid->column('sellMember.nickname', __('卖家'));
        $grid->column('product.name', __('商品'));
//        $grid->column('remark', __('备注'));
        $grid->column('number', __('件数'));
        $grid->column('total', __('总价(易读点)'));
        $grid->column('service_fee', __('服务费(RMB)'));
//        $grid->column('address', __('收货地址'));
        $grid->column('paid_at', __('支付时间'));
        $grid->column('payment_method', __('支付方式'))->display(function ($payment_method){
            return BookOrder::$paymentMethodMap[$payment_method];
        });
//        $grid->column('payment_no', __('支付平台单号'));
//        $grid->column('closed', __('是否关闭订单'));
        $grid->column('mail_method', __('邮寄方式'))->display(function ($mail_method) {
            return BookOrder::$mailMethodMap[$mail_method];
        });
        $grid->column('ship_status', __('物流状态'))->display(function ($ship_status) {
            return BookOrder::$shipStatusMap[$ship_status];
        });
//        $grid->column('ship_data', __('物流数据'));
        $grid->column('created_at', __('生成时间'));
//        $grid->column('updated_at', __('修改时间'));

        $grid->actions(function ($actions) {
            // 去掉删除
            $actions->disableDelete();
            // 去掉编辑
            $actions->disableEdit();
            // 去掉查看
//            $actions->disableView();
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
        $show = new Show(BookOrder::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
//                $tools->disableList();
                $tools->disableDelete();
            });

        $show->field('id', __('Id'));
        $show->field('no', __('订单'));
        $show->field('buyMember', __('买家'))->as(function ($buyMember){
            return $buyMember->nickname;
        });
        $show->field('sellMember', __('卖家'))->as(function ($sellMember){
            return $sellMember->nickname;
        });
        $show->field('product', __('商品'))->as(function ($product){
            return $product->name;
        });
        $show->field('remark', __('备注'));
        $show->field('number', __('购买数量'));
        $show->field('total', __('总价'));
        $show->field('service_fee', __('服务费'));
        $show->field('address', __('地址'));
        $show->field('paid_at', __('支付时间'));
        $show->field('payment_method', __('服务费支付方式'))->as(function ($payment_method){
            return BookOrder::$paymentMethodMap[$payment_method];
        });
        $show->field('payment_no', __('服务费支付单号'));
//        $show->field('refund_status', __('Refund status'));
//        $show->field('refund_no', __('Refund no'));
        $show->field('closed', __('订单是否关闭'));
        $show->field('mail_method', __('邮寄方式'))->as(function ($mail_method){
            return BookOrder::$mailMethodMap[$mail_method];
        });
        $show->field('ship_status', __('物流状态'))->as(function ($ship_status){
            return BookOrder::$shipStatusMap[$ship_status];
        });
        $show->field('ship_data', __('物流数据'));
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
        $form = new Form(new BookOrder());

        $form->text('no', __('No'));
        $form->number('buy_id', __('Buy id'));
        $form->number('sell_id', __('Sell id'));
        $form->number('pid', __('Pid'));
        $form->textarea('remark', __('Remark'));
        $form->number('number', __('Number'))->default(1);
        $form->decimal('total', __('Total'))->default(0.00);
        $form->decimal('service_fee', __('Service fee'))->default(0.00);
        $form->textarea('address', __('Address'));
        $form->datetime('paid_at', __('Paid at'))->default(date('Y-m-d H:i:s'));
        $form->switch('payment_method', __('Payment method'))->default(1);
        $form->text('payment_no', __('Payment no'));
        $form->switch('refund_status', __('Refund status'));
        $form->text('refund_no', __('Refund no'));
        $form->switch('closed', __('Closed'));
        $form->switch('mail_method', __('Mail method'))->default(1);
        $form->switch('ship_status', __('Ship status'))->default(1);
        $form->textarea('ship_data', __('Ship data'));

        return $form;
    }
}
