<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Layout\Content;
use Illuminate\Database\Eloquent\Model;

class Voucher extends RowAction
{
    public $name = '兑换券';

    /**
     * @return string
     */
    public function href()
    {

        return '/admin/members/'.$this->getKey().'/voucher';
    }

}