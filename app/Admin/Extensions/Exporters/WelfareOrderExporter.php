<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/22 0022
 * Time: 22:25
 */

namespace App\Admin\Extensions\Exporters;

use App\Models\BookOrder;
use App\Models\MessagePush;
use App\Models\Messages;
use App\Models\Welfare;
use App\Models\WelfareOrder;
use Encore\Admin\Grid\Exporters\ExcelExporter;
use Maatwebsite\Excel\Concerns\WithMapping;

class WelfareOrderExporter extends ExcelExporter  implements WithMapping
{
    protected $fileName = '福利订单列表.xlsx';

    protected $columns = [
        'id' => 'id',
        'no' => '订单号',
        'mid' => '买家昵称',
        'wid' => '商品名称',
        'type' => '商品类型',
        'number' => '购买件数',
        'total' => '总价（易读点）',
        'cash' => '现金',
        'address' => '收货地址',
        'paid_at' => '支付时间',
        'payment_method' => '支付方式',
        'payment_no' => '服务费支付平台订单号',
        'closed' => '是否关闭订单',
        'ship_status' => '物流状态',
        'ship_data' => '物流数据',
        'created_at' => '生成时间',
        'updated_at' => '修改时间',

    ];


    public function map($product) : array
    {
        return [
            $product->id,
            $product->no,
            $product->member->nickname,
            $product->welfare->name,
            $product->welfareType->cate_name,
            $product->number,
            $product->total,
            $product->service_fee,
            $product->address,
            $product->paid_at,
            $product->payment_method = WelfareOrder::$paymentMethodMap[$product->payment_method],
            $product->payment_no,
            $product->closed = WelfareOrder::$closedMap[$product->closed],
            $product->ship_status = WelfareOrder::$shipStatusMap[$product->ship_status],
            $product->ship_data,
            $product->created_at,
            $product->updated_at,
        ];
    }
}