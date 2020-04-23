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

class OpinionExporter extends ExcelExporter  implements WithMapping
{
    protected $fileName = '意见反馈列表.xlsx';

    protected $columns = [
        'id' => 'id',
        'mid' => '会员昵称',
        'content' => '意见内容',
        'created_at' => '生成时间',
        'updated_at' => '修改时间',

    ];


    public function map($product) : array
    {
        return [
            $product->id,
            $product->member->nickname,
            $product->content,
            $product->created_at,
            $product->updated_at,

        ];
    }
}