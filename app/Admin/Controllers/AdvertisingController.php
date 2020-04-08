<?php

namespace App\Admin\Controllers;

use App\Models\Advertising;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdvertisingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '启动广告';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Advertising());

        $grid->column('id', __('Id'));
        $grid->column('image', __('广告图'))->display(function ($image) {
            return "<img style='width: 50px;' src=".env('IMG_URL').$image.">";
        });
        $grid->column('time', __('显示时长(秒)'));
        $grid->column('link', __('网址'));
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
        $show = new Show(Advertising::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('image', __('广告图'))->image();
        $show->field('time', __('显示时长'));
        $show->field('link', __('网址'));
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
        $form = new Form(new Advertising());

        $form->image('image', __('广告图'))->rules('required',['required' => '广告图是必须的']);
        $form->number('time', __('显示时长(秒)'))->rules('required',['required' => '显示时长是必须的']);
        $form->url('link', __('网址'));
        $states = [
            'on'  => ['value' => 1, 'text' => '正常', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '弃用', 'color' => 'danger'],
        ];

        $form->switch('status', '是否使用')->states($states);
        return $form;
    }
}
