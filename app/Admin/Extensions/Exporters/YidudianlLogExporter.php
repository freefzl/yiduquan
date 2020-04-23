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

class YidudianlLogExporter extends ExcelExporter  implements WithMapping
{
    protected $fileName = '易读点记录列表.xlsx';

    protected $columns = [
        'id' => 'id',
        'mid' => '会员昵称',
        'title' => '记录信息',
        'yidudian' => '易读点',
        'created_at' => '生成时间',
        'updated_at' => '修改时间',

    ];


    public function map($product) : array
    {
        return [
            $product->id,
            $product->member->nickname,
            $product->title,
            $product->yidudian,
            $product->created_at,
            $product->updated_at,
        ];
    }
}