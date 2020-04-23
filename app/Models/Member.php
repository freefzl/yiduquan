<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use DefaultDatetimeFormat;

    protected $table='members';

    const LEVEL_0 = 0;
    const LEVEL_1 = 1;
    const LEVEL_2 = 2;

    public static $levelMap = [
        self::LEVEL_0   => '游客',
        self::LEVEL_1  => '会员',
        self::LEVEL_2  => '贵宾',
    ];

    public function child()
    {
        return $this->hasMany(get_class($this), 'referees', 'id');
    }

    public function parent()
    {
        return $this->hasOne(get_class($this), 'id', 'referees');
    }

    public function integralLog()
    {
        return $this->hasMany(IntegralLog::class);
    }

    public function yidudianLog()
    {
        return $this->hasMany(YidudianLog::class);
    }

    public function shareLog()
    {
        return $this->hasMany(ShareLog::class);
    }

    public function Address()
    {
        return $this->hasMany(Address::class);
    }

    public function voucher()
    {
        return $this->hasMany(Voucher::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function bookOrder()
    {
        return $this->hasMany(BookOrder::class);
    }


    public function friends()
    {
        return $this->hasMany(Friends::class);
    }

    public function message()
    {
        return $this->hasMany(Messages::class);
    }

    public function messagePush()
    {
        return $this->hasMany(MessagePush::class);
    }

    public function opinion()
    {
        return $this->hasMany(Opinion::class);
    }
}
