<?php

namespace App\Admin\Controllers;

use App\Models\Member;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MemberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '会员';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Member());

        $grid->disableCreateButton();

        $grid->column('id', __('Id'));
        $grid->column('head', __('头像'))->display(function ($head, $grid) {
            if ($head) {
                return "<img style='width: 50px;' src=".env('IMG_URL').$head.">";
            }
            return $grid->gravatar(40);
        });
        $grid->column('nickname', __('昵称'));
        $grid->column('mobile', __('手机号'));
        $grid->column('name', __('姓名'));
//        $grid->column('weixin', __('微信号'));
//        $grid->column('qq', __('QQ'));
        $grid->column('city', __('城市'));
        $grid->column('yidudian', __('易读点'));
        $grid->column('integral', __('积分'));
        $grid->column('balance', __('余额'));
        $grid->column('referees', __('推荐人'))->display(function ($referees) {
            if ($referees) {
                return Member::find($referees)->nickname;
            }
            return '无';
        });
        $grid->column('level', __('等级'))->display(function ($level) {
            if ($level == 0) {
                return '游客';
            }else if ($level == 1) {
                return '会员';
            }else if ($level == 2) {
                return '贵宾';
            }
        });
        $grid->column('created_at', __('生成时间'));
        $grid->column('updated_at', __('修改时间'));
        $states = [
            'on'  => ['value' => 1, 'text' => '正常', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '冻结', 'color' => 'default'],
        ];
        $grid->column('status', '是否使用')->switch($states);
        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('nickname', '昵称');
            $filter->like('mobile', '手机号');
            $filter->like('name', '姓名');
            $filter->equal('level', '会员等级')->select(['0' => '游客','1' => '会员','2' => '贵宾']);
            $filter->between('created_at', '生成时间')->datetime();


        });

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

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Member::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
//                $tools->disableList();
                $tools->disableDelete();
            });

        $show->field('id', __('Id'));
        $show->field('open_id', __('Open id'));
        $show->field('head', __('Head'))->image();
        $show->field('nickname', __('Nickname'));
        $show->field('mobile', __('Mobile'));
        $show->field('name', __('Name'));
        $show->field('weixin', __('Weixin'));
        $show->field('qq', __('Qq'));
        $show->field('city', __('City'));
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
        $form = new Form(new Member());

        $form->text('open_id', __('微信openid'));
        $form->image('head', __('头像'));
        $form->text('nickname', __('昵称'));
        $form->mobile('mobile', __('手机号码'));
        $form->text('email', __('邮箱'));
        $form->text('name', __('姓名'));
        $form->text('weixin', __('微信号'));
        $form->text('qq', __('qq'));
        $form->text('city', __('所在城市'));
        $form->text('yidudian', __('易读点'));
        $form->text('integral', __('积分'));
        $form->text('balance', __('余额'));
        $states = [
            'on'  => ['value' => 1, 'text' => '正常', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '冻结', 'color' => 'danger'],
        ];
        $form->switch('status', '是否使用')->states($states);
        return $form;
    }
}
