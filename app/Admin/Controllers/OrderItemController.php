<?php

namespace App\Admin\Controllers;

use App\Models\OrderItem;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderItemController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\OrderItem';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OrderItem());

        $grid->column('id', __('Id'));
        $grid->column('order_id', __('Order id'));
        $grid->column('product_id', __('Product id'));
        $grid->column('amount', __('Amount'));
        $grid->column('price', __('Price'));
        $grid->column('rating', __('Rating'));
        $grid->column('review', __('Review'));
        $grid->column('reviewed_at', __('Reviewed at'));

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
        $show = new Show(OrderItem::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('order_id', __('Order id'));
        $show->field('product_id', __('Product id'));
        $show->field('amount', __('Amount'));
        $show->field('price', __('Price'));
        $show->field('rating', __('Rating'));
        $show->field('review', __('Review'));
        $show->field('reviewed_at', __('Reviewed at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new OrderItem());

        $form->number('order_id', __('Order id'));
        $form->number('product_id', __('Product id'));
        $form->number('amount', __('Amount'));
        $form->currency('price', __('Price'))->default(0.00);
        $form->number('rating', __('Rating'));
        $form->textarea('review', __('Review'));
        $form->datetime('reviewed_at', __('Reviewed at'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
