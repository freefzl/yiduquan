<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Exporters\MessageExporter;
use App\Models\Messages;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use function foo\func;

class MessagesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '消息';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Messages());

        $grid->disableCreateButton();
        $grid->disableActions();

        $grid->column('id', __('Id'));
        $grid->column('member.nickname', __('会员昵称'));
        $grid->column('title', __('消息标题'));
        $grid->column('content', __('消息内容'))->style('max-width:200px;')->display(function ($content){
            return $content;
        });
        $grid->column('type', __('消息类型'))->display(function ($type) {
            return Messages::$typeMap[$type];
        });
        $grid->column('read', __('是否阅读'))->display(function ($type) {
            return Messages::$readMap[$type];
        });
        $states = [
            'on'  => ['value' => 1, 'text' => '可见', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '隐藏', 'color' => 'default'],
        ];
        $grid->column('status', '是否显示')->switch($states);
        
        
        $grid->column('created_at', __('生成时间'));



        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->equal('type', '消息类型')->select(Messages::$typeMap);
            $filter->equal('read', '是否阅读')->select(Messages::$readMap);
            $filter->like('member.nickname', '会员昵称');
            $filter->like('title', '消息标题');
            $filter->between('created_at', '生成时间')->datetime();

        });

        $grid->exporter(new MessageExporter());

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
        $show = new Show(Messages::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
//                $tools->disableList();
                $tools->disableDelete();
            });

        $show->field('id', __('Id'));
        $show->field('member', __('会员昵称'))->as(function ($member){
            return $member->nickname;
        });
        $show->field('title', __('消息标题'));
        $show->field('content', __('消息内容'));
        $show->field('type', __('消息类型'))->as(function ($type){
            if ($type == Messages::TYPE_1) {
                return Messages::$typeMap[Messages::TYPE_1];
            }else if ($type == Messages::TYPE_2) {
                return Messages::$typeMap[Messages::TYPE_2];
            } else if ($type == Messages::TYPE_3) {
                return Messages::$typeMap[Messages::TYPE_3];
            }
        });
        $show->field('status', __('是否显示'))->as(function ($status) {
            if ($status === 1) {
                return '可见';
            }else {
                return '隐藏';
            }
        });
        $show->field('created_at', __('生成时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Messages());

        $form->number('mid', __('Mid'));
        $form->text('title', __('Title'));
        $form->text('content', __('Content'));
        $form->switch('type', __('Type'))->default(1);
        $form->switch('status', __('Status'));

        return $form;
    }
}
