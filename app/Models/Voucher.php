<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use DefaultDatetimeFormat;


    public function member()
    {
        return $this->belongsTo(Member::class, 'mid', 'id');
    }

    public function welfare()
    {
        return $this->belongsTo(Welfare::class, 'wid', 'id');
    }
}
