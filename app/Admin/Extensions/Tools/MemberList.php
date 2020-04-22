<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class MemberList extends AbstractTool
{

    protected function script()
    {
        $url = admin_url('members');

        return <<<EOT

$('.mybut').on('click', function(){
    window.location.href = "$url";
})

EOT;
    }

    public function render()
    {
        Admin::script($this->script());

        return view('admin.member.list');
    }
}