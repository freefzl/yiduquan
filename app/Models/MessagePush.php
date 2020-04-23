<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class MessagePush extends Model
{
    use DefaultDatetimeFormat;

    const TYPE_1 = 1;
//    const TYPE_2 = 2;
    const TYPE_3 = 3;

    const MYCLASS_1 = 1;
    const MYCLASS_2 = 2;
    const MYCLASS_3 = 3;
    const MYCLASS_4 = 4;

    public static $typeMap = [
        self::TYPE_1   => '系统消息',
//        self::TYPE_2 => '短信消息',
        self::TYPE_3 => '公众号消息',
    ];

    public static $MyClassMap = [
        self::MYCLASS_1   => '全部群发',
        self::MYCLASS_2 => '指定群发',
        self::MYCLASS_3 => '条件群发',
        self::MYCLASS_4 => '反馈回复',
    ];


    public function member()
    {
        return $this->belongsTo(Member::class, 'mid', 'id');
    }
}
