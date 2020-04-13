<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class WelfareOrder extends Model
{
    use DefaultDatetimeFormat;

    const  PAYMENT_METHOD_1 = 1;
    const  PAYMENT_METHOD_2 = 2;

    const  CLOSED_0 = 0;
    const  CLOSED_1 = 1;


    const SHIP_STATUS_1 = 1;
    const SHIP_STATUS_2 = 2;
    const SHIP_STATUS_3 = 3;

    public static $paymentMethodMap = [
        self::PAYMENT_METHOD_1   => '会员易读点',
        self::PAYMENT_METHOD_2  => '贵宾易读点',
    ];

    public static $closedMap = [
        self::CLOSED_0   => '未关闭订单',
        self::CLOSED_1  => '已关闭订单',
    ];


    public static $shipStatusMap = [
        self::SHIP_STATUS_1   => '未发货',
        self::SHIP_STATUS_2 => '已发货',
        self::SHIP_STATUS_3  => '已收货',
    ];




    public function member()
    {
        return $this->belongsTo(Member::class, 'mid', 'id');
    }


    public function welfare()
    {
        return $this->belongsTo(Welfare::class, 'wid', 'id');
    }

    public function welfareType()
    {
        return $this->belongsTo(WelfareType::class, 'type', 'id');
    }
}
