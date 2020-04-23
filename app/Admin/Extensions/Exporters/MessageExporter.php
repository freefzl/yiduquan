<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/22 0022
 * Time: 22:25
 */

namespace App\Admin\Extensions\Exporters;

use App\Models\Messages;
use Encore\Admin\Grid\Exporters\ExcelExporter;
use Maatwebsite\Excel\Concerns\WithMapping;

class MessageExporter extends ExcelExporter  implements WithMapping
{
    protected $fileName = '消息列表.xlsx';

    protected $columns = [
        'id' => 'id',
        'mid' => '会员昵称',
        'title' => '消息标题',
        'content' => '消息内容',
        'type' => '消息类型',
        'read' => '是否阅读',
        'status' => '是否可见',
        'created_at' => '生成时间',
        'updated_at' => '修改时间',

    ];


    public function map($product) : array
    {
        $type = Messages::$typeMap[$product->type];
        $read = Messages::$readMap[$product->read];

        return [
            $product->id,
            $product->member->nickname,
            $product->title,
            $product->content,
            $product->type = $type,
            $product->read = $read,
            $product->status ? '显示' : '隐藏',
            $product->created_at,
            $product->updated_at,

        ];
    }
}