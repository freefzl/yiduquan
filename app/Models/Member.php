<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use DefaultDatetimeFormat;

    protected $table='members';

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

    public function order()
    {
        return $this->hasMany(Order::class);
    }


    public function friends()
    {
        return $this->hasMany(Friends::class);
    }
}
