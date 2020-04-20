<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use DefaultDatetimeFormat;

    protected $casts = [
        'conditions' => 'json',
    ];

    public function getExtraAttribute($conditions)
    {
        return array_values(json_decode($conditions, true) ?: []);
    }

    public function setExtraAttribute($conditions)
    {
        $this->attributes['conditions'] = json_encode(array_values($conditions));
    }

    public function welfare()
    {
        return $this->belongsTo(Welfare::class, 'wid', 'id');
    }
}
