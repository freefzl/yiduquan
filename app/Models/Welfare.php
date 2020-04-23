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

    public function article(){
        return $this->hasMany(Article::class);
    }

    public function type()
    {
        return $this->belongsTo(WelfareType::class, 'type_id', 'id');
    }
}
