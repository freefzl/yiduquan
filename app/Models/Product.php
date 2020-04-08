<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use DefaultDatetimeFormat, SoftDeletes;

    public function member()
    {

        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
