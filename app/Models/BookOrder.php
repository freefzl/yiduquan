<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class BookOrder extends Model
{
    use DefaultDatetimeFormat;

    const  PAYMENT_METHOD_1 = 1;
    const  PAYMENT_METHOD_2 = 2;

    const  CLOSED_0 = 0;
    const  CLOSED_1 = 1;

    const  MAIL_METHOD_1 = 1;
    const  MAIL_METHOD_2 = 2;

    const SHIP_STATUS_1 = 1;
    const SHIP_STATUS_2 = 2;
    const SHIP_STATUS_3 = 3;

    public static $paymentMethodMap = [
        self::PAYMENT_METHOD_1   => '会员支付',
        self::PAYMENT_METHOD_2  => '贵宾支付',
    ];

    public static $closedMap = [
        self::CLOSED_0   => '未关闭订单',
        self::CLOSED_1  => '已关闭订单',
    ];

    public static $mailMethodMap = [
        self::MAIL_METHOD_1   => '自提',
        self::MAIL_METHOD_2  => '邮寄',
    ];

    public static $shipStatusMap = [
        self::SHIP_STATUS_1   => '未发货',
        self::SHIP_STATUS_2 => '已发货',
        self::SHIP_STATUS_3  => '已收货',
    ];




    public function buyMember()
    {
        return $this->belongsTo(Member::class, 'buy_id', 'id');
    }

    public function sellMember()
    {
        return $this->belongsTo(Member::class, 'sell_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'pid', 'id');
    }
}
