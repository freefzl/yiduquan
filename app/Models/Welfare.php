<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Welfare extends Model
{
    use DefaultDatetimeFormat, SoftDeletes;


    public function voucher()
    {
        return $this->hasMany(Voucher::class);
    }
}