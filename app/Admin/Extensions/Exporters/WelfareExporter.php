<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/22 0022
 * Time: 22:25
 */

namespace App\Admin\Extensions\Exporters;

use Encore\Admin\Grid\Exporters\ExcelExporter;
use Maatwebsite\Excel\Concerns\WithMapping;

class WelfareExporter extends ExcelExporter  implements WithMapping
{
    protected $fileName = '福利商品列表.xlsx';

    protected $columns = [
        'id' => 'id',
        'image' => '商品图片',
        'type_id' => '商品类型',
        'name' => '商品名称',
        'inventory' => '库存(件)',
        'postage' => '邮费说明',
        'price' => '兑换价(易读点)',
        'cash' => '现金',
        'status' => '商品状态',
        'created_at' => '生成时间',
        'updated_at' => '修改时间',

    ];


    public function map($product) : array
    {

        return [
            $product->id,
            $product->image,
            $product->type->cate_name,
            $product->name,
            $product->inventory,
            $product->postage,
            $product->price,
            $product->cash,
            $product->status ? '上架中' : '已下架',
            $product->created_at,
            $product->updated_at,

        ];
    }
}