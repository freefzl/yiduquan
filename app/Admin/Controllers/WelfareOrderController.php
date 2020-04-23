<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Exporters\WelfareOrderExporter;
use App\Models\WelfareOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WelfareOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '福利订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WelfareOrder());
        $grid->disableCreateButton();

        $grid->column('id', __('Id'));
        $grid->column('no', __('订单号'));
        $grid->column('member.nickname', __('买家'));
        $grid->column('welfare.name', __('福利商品'));
        $grid->column('welfareType.cate_name', __('商品类型'));
        $grid->column('number', __('件数'));
        $grid->column('total', __('总价(易读点)'));
        $grid->column('cash', __('现金'));
        $grid->column('address', __('地址'));
        $grid->column('paid_at', __('现金支付时间'));
        $grid->column('payment_method', __('现金支付方式'))->display(function ($payment_method){
            return WelfareOrder::$paymentMethodMap[$payment_method] ?? '';
        });
        $grid->column('payment_no', __('支付平台单号'));
//        $grid->column('refund_status', __('Refund status'));
//        $grid->column('refund_no', __('Refund no'));
        $grid->column('closed', __('是否关闭订单'))->display(function ($closed){
            return WelfareOrder::$closedMap[$closed] ?? '';
        });
        $grid->column('ship_status', __('物流状态'))->display(function ($ship_status){
            return WelfareOrder::$shipStatusMap[$ship_status] ?? '';
        });
//        $grid->column('ship_data', __('物流数据'));
        $grid->column('created_at', __('生成时间'));


        $grid->actions(function ($actions) {
            // 去掉删除
            $actions->disableDelete();
            // 去掉编辑
            $actions->disableEdit();
            // 去掉查看
//            $actions->disableView();
        });

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        $grid->exporter(new WelfareOrderExporter());

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
        $show = new Show(WelfareOrder::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
//                $tools->disableList();
                $tools->disableDelete();
            });

        $show->field('id', __('Id'));
        $show->field('no', __('订单号'));
        $show->field('member', __('买家'))->as(function ($buyMember){
            return $buyMember->nickname;
        });
        $show->field('welfare', __('福利商品'))->as(function ($welfare){
            return $welfare->name;
        });
        $show->field('welfareType', __('商品类型'))->as(function ($welfareType){
            return $welfareType->cate_name;
        });
        $show->field('number', __('件数'));
        $show->field('total', __('总价(易读点)'));
        $show->field('cash', __('现金'));
        $show->field('address', __('地址'));
        $show->field('paid_at', __('现金支付时间'));
        $show->field('payment_method', __('现金支付方式'))->as(function ($payment_method){
            return WelfareOrder::$paymentMethodMap[$payment_method];
        });
        $show->field('payment_no', __('支付平台单号'));
//        $show->field('refund_status', __('Refund status'));
//        $show->field('refund_no', __('Refund no'));
        $show->field('closed', __('是否关闭订单'))->as(function ($closed){
            return WelfareOrder::$closedMap[$closed];
        });
        $show->field('ship_status', __('物流状态'))->as(function ($ship_status){
            return WelfareOrder::$shipStatusMap[$ship_status];
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
        $form = new Form(new WelfareOrder());

        $form->text('no', __('No'));
        $form->number('mid', __('Mid'));
        $form->number('wid', __('Wid'));
        $form->number('type', __('Type'));
        $form->number('number', __('Number'))->default(1);
        $form->decimal('total', __('Total'))->default(0.00);
        $form->decimal('cash', __('Cash'))->default(0.00);
        $form->textarea('address', __('Address'));
        $form->datetime('paid_at', __('Paid at'))->default(date('Y-m-d H:i:s'));
        $form->switch('payment_method', __('Payment method'))->default(1);
        $form->text('payment_no', __('Payment no'));
        $form->switch('refund_status', __('Refund status'));
        $form->text('refund_no', __('Refund no'));
        $form->switch('closed', __('Closed'));
        $form->switch('ship_status', __('Ship status'))->default(1);
        $form->textarea('ship_data', __('Ship data'));

        return $form;
    }
}
