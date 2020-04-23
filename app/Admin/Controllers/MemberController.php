<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\Address;
use App\Admin\Extensions\Exporters\MemberExporter;
use App\Admin\Extensions\Exporters\MyAddressExporter;
use App\Admin\Extensions\Exporters\MyBookOrderExporter;
use App\Admin\Extensions\Exporters\MyFriendsExporter;
use App\Admin\Extensions\Exporters\MyVoucherExporter;
use App\Admin\Extensions\Exporters\MyWelfareOrderExporter;
use App\Admin\Extensions\Tools\MemberList;
use App\Models\BookOrder;
use App\Models\Friends;
use App\Models\Member;
use App\Models\Voucher;
use App\Models\WelfareOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
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
        $grid->column('open_id', __('微信openid'));
        $grid->column('head', __('头像'))->display(function ($head, $grid) {
            if ($head) {
                return "<img style='width: 50px;' src=".env('IMG_URL').$head.">";
            }
            return $grid->gravatar(40);
        });
        $grid->column('nickname', __('昵称'));
        $grid->column('mobile', __('手机号'));
        $grid->column('name', __('姓名'));
        $grid->column('weixin', __('微信号'));
        $grid->column('qq', __('QQ'));
        $grid->column('city', __('城市'));
        $grid->column('yidudian', __('易读点'));
        $grid->column('integral', __('积分'));
        $grid->column('balance', __('余额'));
        $grid->column('parent.nickname', __('推荐人'));
        $grid->column('level', __('等级'))->display(function ($level) {
            return Member::$levelMap[$level];
        });
//        $grid->column('active', __('活跃度'));
        $grid->column('longitude', __('经度'));
        $grid->column('latitude', __('纬度'));
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
            $actions->disableView();

            $actions->add(new Address);
            $actions->add(new \App\Admin\Actions\Post\Friends());
            $actions->add(new \App\Admin\Actions\Post\Voucher());
            $actions->add(new \App\Admin\Actions\Post\BookOrder());
            $actions->add(new \App\Admin\Actions\Post\WelfareOrder());
        });

        $grid->exporter(new MemberExporter());

        return $grid;
    }

    public function welfareOrders($id, Content $content)
    {
        $content->header('我的福利订单');

        $grid = new Grid(new WelfareOrder());
        $grid->model()->where(['mid' => $id]);
        $grid->disableCreateButton();
        $grid->disableActions();

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




        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
            $tools->append(new MemberList());
        });

        $grid->exporter(new MyWelfareOrderExporter());
        
        $content->body($grid);
        return $content;
    }

    public function bookOrders($id, Content $content)
    {
        $content->header('我的换书订单');

        $grid = new Grid(new BookOrder());
        $grid->model()->where(['buy_id' => $id]);
        $grid->disableCreateButton();
        $grid->disableActions();

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



        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
            $tools->append(new MemberList());
        });

        $grid->exporter(new MyBookOrderExporter());

        $content->body($grid);
        return $content;
    }

    public function voucher($id, Content $content)
    {
        $content->header('我的福利卡');

        $grid = new Grid(new Voucher());
        $grid->model()->where(['mid' => $id]);
        $grid->disableCreateButton();
        $grid->disableActions();

        $grid->column('id', __('Id'));
        $grid->column('member.nickname', __('会员昵称'));
        $grid->column('welfare.name', __('商品名称'));
        $grid->column('type', __('获取类型'))->display(function($type) {
            if ($type == 1) {
                return '系统赠予';
            }else if ($type == 2) {
                return '积分兑换';
            }
        });
        $grid->column('status', __('状态'))->display(function($status){
            if ($status == 0) {
                return '未使用';
            }else if ($status == 1) {
                return '已使用';
            } else if ($status == 2) {
                return '已过期';
            }
        });
        $grid->column('created_at', __('生成时间'));
        $grid->column('updated_at', __('修改时间'));



        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('member.nickname', '会员昵称');
            $filter->like('welfare.name', '商品名称');
            $filter->between('created_at', '生成时间')->datetime();

        });

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
            $tools->append(new MemberList());
        });

        $grid->exporter(new MyVoucherExporter());

        $content->body($grid);
        return $content;
    }

    public function friends($id, Content $content)
    {
        $content->header('我的好友');

        $grid = new Grid(new Friends());
        $grid->model()->where(['mid' => $id]);
        $grid->disableCreateButton();
        $grid->disableActions();

        $grid->column('id', __('Id'));
        $grid->column('member.nickname', __('会员昵称'));
        $grid->column('friend.nickname', __('好友昵称'));
        $grid->column('created_at', __('生成时间'));
        $grid->column('updated_at', __('修改时间'));

        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('member.nickname', '会员昵称');
            $filter->like('friend.nickname', '好友昵称');
            $filter->between('created_at', '生成时间')->datetime();


        });

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
            $tools->append(new MemberList());
        });

        $grid->exporter(new MyFriendsExporter());

        $content->body($grid);
        return $content;
    }

    public function address($id, Content $content)
    {
        $content->header('我的地址');

        $grid = new Grid(new \App\Models\Address());
        $grid->model()->where(['mid' => $id]);
        $grid->disableCreateButton();
        $grid->disableActions();

        $grid->column('id', __('Id'));
        $grid->column('member.nickname', __('会员昵称'));
        $grid->column('name', __('名称'));
        $grid->column('mobile', __('手机号'));
        $grid->column('province', __('省'));
        $grid->column('city', __('市'));
        $grid->column('area', __('区'));
        $grid->column('address', __('详情地址'));
        $grid->column('status', __('状态'));
        $grid->column('created_at', __('生成时间'));
        $grid->column('updated_at', __('修改时间'));
        $grid->column('default', __('默认地址'))->bool();


        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('member.nickname', '商品名称');
            $filter->like('address', '详情地址');
            $filter->between('created_at', '生成时间')->datetime();

        });

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
            $tools->append(new MemberList());
        });


        $grid->exporter(new MyAddressExporter());

        $content->body($grid);
        return $content;
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
