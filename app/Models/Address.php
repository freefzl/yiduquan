<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use DefaultDatetimeFormat;

    public function member()
    {
        return $this->belongsTo(Member::class, 'mid', 'id');
    }
}
