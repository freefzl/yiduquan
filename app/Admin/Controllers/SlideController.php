<?php

namespace App\Admin\Controllers;

use App\Models\Slide;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SlideController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '幻灯片';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Slide());

        $grid->column('id', __('Id'));
        $grid->column('image', __('图片'))->display(function ($image) {
            return "<img style='width: 50px;' src=".env('IMG_URL').$image.">";
        });
        $grid->column('url', __('地址'));
        $grid->column('created_at', __('生成时间'));
        $grid->column('updated_at', __('修改时间'));
        $states = [
            'on'  => ['value' => 1, 'text' => '正常', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '弃用', 'color' => 'default'],
        ];
        $grid->column('status','是否使用')->switch($states);

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
        $show = new Show(Slide::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('image', __('Image'));
        $show->field('url', __('Url'));
        $show->field('status', __('Status'));
        $show->field('type', __('Type'));
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
        $form = new Form(new Slide());

        $form->image('image', __('图片'))->rules('required',['required' => '图片是必须的']);
        $form->url('url', __('url地址'));
        $states = [
            'on'  => ['value' => 1, 'text' => '正常', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '弃用', 'color' => 'danger'],
        ];

        $form->switch('status', '是否使用')->states($states);

        return $form;
    }
}
