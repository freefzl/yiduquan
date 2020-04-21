<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class MemberList extends AbstractTool
{

    public function render()
    {
        $url = admin_url('members');

        return view('admin.member.list', compact('url'));
    }
}