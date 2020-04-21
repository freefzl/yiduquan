<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Layout\Content;
use Illuminate\Database\Eloquent\Model;

class WelfareOrder extends RowAction
{
    public $name = '福利订单';

    /**
     * @return string
     */
    public function href()
    {

        return '/admin/members/'.$this->getKey().'/welfareOrders';
    }

}