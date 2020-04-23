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

class ArticleExporter extends ExcelExporter  implements WithMapping
{
    protected $fileName = '平台活动列表.xlsx';

    protected $columns = [
        'id' => 'id',
        'wid' => '活动商品',
        'start_at' => '活动开始时间',
        'end_at' => '活动结束时间',
        'title' => '活动标题',
        'created_at' => '生成时间',
        'updated_at' => '修改时间',

    ];


    public function map($product) : array
    {
        return [
            $product->id,
            $product->welfare->name,
            $product->start_at,
            $product->end_at,
            $product->title,
            $product->created_at,
            $product->updated_at,
        ];
    }
}