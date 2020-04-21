<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Layout\Content;
use Illuminate\Database\Eloquent\Model;

class BookOrder extends RowAction
{
    public $name = '换书订单';

    /**
     * @return string
     */
    public function href()
    {

        return '/admin/members/'.$this->getKey().'/bookOrders';
    }

}