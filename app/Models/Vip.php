<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vip extends Model
{
    protected $fillable = [
      'annual_fee', 'breaks', 'image', 'status'
    ];
}
