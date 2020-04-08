<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Tab;

class SettingController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Setting';

    public function settings(Content $content)
    {
        $forms = [
            'basic'    => \App\Admin\Forms\Setting::class,
            'platform_rules'    => \App\Admin\Forms\PlatformRules::class,
            'vip'    => \App\Admin\Forms\Vip::class,
        ];

        return $content
            ->title('系统设置')
            ->body(Tab::forms($forms));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Setting());

        $grid->column('id', __('Id'));
        $grid->column('key', __('Key'));
        $grid->column('val', __('Val'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Setting::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('key', __('Key'));
        $show->field('val', __('Val'));
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
        $form = new Form(new Setting());

        $form->text('key', __('Key'));
        $form->textarea('val', __('Val'));

        return $form;
    }
}
