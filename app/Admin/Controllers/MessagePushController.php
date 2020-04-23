<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Exporters\MessagePushExporter;
use App\Models\MessagePush;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Tab;

class MessagePushController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '消息推送';




    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MessagePush());

        $grid->disableCreateButton();
        $grid->disableActions();

        $grid->column('id', __('Id'));
        $grid->column('member.nickname', __('会员昵称'));
        $grid->column('title', __('消息标题'));
        $grid->column('content', __('消息内容'))->style('max-width:200px;')->display(function ($content){
            return $content;
        });
        $grid->column('type', __('消息类型'))->display(function ($type) {
            if ($type == MessagePush::TYPE_1) {
                return MessagePush::$typeMap[MessagePush::TYPE_1];
            } else if ($type == MessagePush::TYPE_3) {
                return MessagePush::$typeMap[MessagePush::TYPE_3];
            }
        });
        $grid->column('class', __('推送方式'))->display(function ($type) {
            if ($type == MessagePush::MYCLASS_1) {
                return MessagePush::$MyClassMap[MessagePush::MYCLASS_1];
            } else if ($type == MessagePush::MYCLASS_2) {
                return MessagePush::$MyClassMap[MessagePush::MYCLASS_2];
            }
        });



        $grid->column('created_at', __('生成时间'));

        $grid->actions(function ($actions) {
            // 去掉删除
            $actions->disableDelete();
            // 去掉编辑
            $actions->disableEdit();
            // 去掉查看
            $actions->disableView();
        });

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器

            $filter->equal('class', '推送方式')->select(MessagePush::$MyClassMap);
            $filter->equal('type', '推送类型')->select(MessagePush::$typeMap);
            $filter->like('member.nickname', '会员昵称');
            $filter->like('title', '消息标题');
            $filter->between('created_at', '生成时间')->datetime();

        });

        $grid->exporter(new MessagePushExporter());

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
        $show = new Show(MessagePush::findOrFail($id));


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
        $show->field('title', __('推送标题'));
        $show->field('content', __('推送内容'))->as(function ($content) {
            return $content;
        });
        $show->field('type', __('推送类型'));
        $show->field('class', __('推送方式'));
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
        $form = new Form(new MessagePush());

        $form->number('mid', __('Mid'));
        $form->text('title', __('Title'));
        $form->textarea('content', __('Content'));
        $form->switch('type', __('Type'))->default(1);

        return $form;
    }
}
