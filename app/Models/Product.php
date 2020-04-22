<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use DefaultDatetimeFormat, SoftDeletes;

    const SUIT_OF_CLASS_1 = 1;
    const SUIT_OF_CLASS_2 = 2;

    public static $suitOfClassMap = [
        self::SUIT_OF_CLASS_1   => '一本',
        self::SUIT_OF_CLASS_2  => '一套',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function bookOrder()
    {
        return $this->hasMany(BookOrder::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class, 'degree_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id', 'id');
    }
}
