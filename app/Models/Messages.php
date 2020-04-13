<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use DefaultDatetimeFormat;

    const TYPE_1 = 1;
    const TYPE_2 = 2;
    const TYPE_3 = 3;

    const READ_0 = 0;
    const READ_1 = 1;

    public static $typeMap = [
        self::TYPE_1   => '系统消息',
//        self::TYPE_2 => '短信消息',
        self::TYPE_3  => '公众号消息',
    ];

    public static $readMap = [
        self::READ_0   => '未读',
        self::READ_1  => '已读',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'mid', 'id');
    }
}
