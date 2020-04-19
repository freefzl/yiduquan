<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use EasyWeChat\Factory;

class MemberController extends Controller
{
    public function index()
    {
        //由于使用了easyWechat中 中间件的方法进行授权，因此一句话搞定直接获取授权用户的信息如下：
        $wechat = session('wechat.oauth_user.default');
//        dd($wechat->id);



        $app = Factory::officialAccount('wechat.official_account.default');
        $users = $app->user->get($wechat->id);
        dd($users);

    }
}
