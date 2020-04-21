<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Layout\Content;
use Illuminate\Database\Eloquent\Model;

class Address extends RowAction
{
    public $name = '地址';

    /**
     * @return string
     */
    public function href()
    {

        return '/admin/members/'.$this->getKey().'/address';
    }

}