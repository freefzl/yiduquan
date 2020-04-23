<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/22 0022
 * Time: 22:25
 */

namespace App\Admin\Extensions\Exporters;

use App\Models\MessagePush;
use App\Models\Messages;
use Encore\Admin\Grid\Exporters\ExcelExporter;
use Maatwebsite\Excel\Concerns\WithMapping;

class FriendsExporter extends ExcelExporter  implements WithMapping
{
    protected $fileName = '好友列表.xlsx';

    protected $columns = [
        'id' => 'id',
        'mid' => '会员昵称',
        'fid' => '好友昵称',
        'created_at' => '生成时间',
//        'updated_at' => '修改时间',

    ];


    public function map($product) : array
    {
        return [
            $product->id,
            $product->member->nickname,
            $product->friend->nickname,
            $product->created_at,
//            $product->updated_at,
        ];
    }
}