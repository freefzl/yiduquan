<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use DefaultDatetimeFormat;

    const TYPE_1 = 1;
    const TYPE_2 = 2;

    const STATUS_0 = 0;
    const STATUS_1 = 1;

    public static $typeMap = [
        self::TYPE_1 => '系统赠予',
        self::TYPE_2 => '积分兑换',
    ];

    public static $statusMap = [
        self::STATUS_0 => '未使用',
        self::STATUS_1 => '已使用',
    ];



    public function member()
    {
        return $this->belongsTo(Member::class, 'mid', 'id');
    }

    public function welfare()
    {
        return $this->belongsTo(Welfare::class, 'wid', 'id');
    }
}
