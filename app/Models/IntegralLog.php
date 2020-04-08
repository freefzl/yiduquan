<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class IntegralLog extends Model
{
    use DefaultDatetimeFormat;

    public function member()
    {
        return $this->belongsTo(Member::class, 'mid', 'id');
    }
}
