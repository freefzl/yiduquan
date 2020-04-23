<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/22 0022
 * Time: 22:25
 */

namespace App\Admin\Extensions\Exporters;

use App\Models\Member;
use App\Models\MessagePush;
use App\Models\Messages;
use Encore\Admin\Grid\Exporters\ExcelExporter;
use Maatwebsite\Excel\Concerns\WithMapping;

class MemberExporter extends ExcelExporter  implements WithMapping
{
    protected $fileName = '会员列表.xlsx';

    protected $columns = [
        'id' => 'id',
        'open_id' => '微信id',
        'head' => '头像',
        'nickname' => '昵称',
        'password' => '密码',
        'mobile' => '手机号码',
        'email' => '邮箱',
        'name' => '姓名',
        'weixin' => '微信号',
        'qq' => 'qq',
        'city' => '所在城市',
        'yidudian' => '易读点',
        'integral' => '积分',
        'balance' => '余额',
        'level' => '等级',
        'referees' => '推荐人',
//        'active' => '活跃度',
        'longitude' => '经度',
        'latitude' => '纬度',
        'status' => '状态',
        'created_at' => '生成时间',
        'updated_at' => '修改时间',

    ];


    public function map($product) : array
    {
        return [
            $product->id,
            $product->open_id,
            $product->head,
            $product->nickname,
            $product->password,
            $product->mobile,
            $product->email,
            $product->name,
            $product->weixin,
            $product->qq,
            $product->city,
            $product->yidudian,
            $product->integral,
            $product->balance,
            $product->level = Member::$levelMap[$product->level],
            $product->referees = $product->parent? $product->parent->nickname : '',
//            $product->active,
            $product->longitude,
            $product->latitude,
            $product->status ? '正常' : '冻结',
            $product->created_at,
            $product->updated_at,
        ];
    }
}