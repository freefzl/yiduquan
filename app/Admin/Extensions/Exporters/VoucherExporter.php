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
use App\Models\Voucher;
use Encore\Admin\Grid\Exporters\ExcelExporter;
use Maatwebsite\Excel\Concerns\WithMapping;

class VoucherExporter extends ExcelExporter  implements WithMapping
{
    protected $fileName = '福利卡列表.xlsx';

    protected $columns = [
        'id' => 'id',
        'mid' => '会员昵称',
        'wid' => '商品名称',
        'type' => '获取类型',
        'status' => '使用状态',
        'created_at' => '生成时间',
        'updated_at' => '修改时间',

    ];


    public function map($product) : array
    {
        return [
            $product->id,
            $product->member->nickname,
            $product->welfare->name,
            $product->type = Voucher::$typeMap[$product->type],
            $product->status = Voucher::$statusMap[$product->status],
            $product->created_at,
            $product->updated_at,
        ];
    }
}