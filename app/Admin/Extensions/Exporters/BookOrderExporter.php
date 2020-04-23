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
use Encore\Admin\Grid\Exporters\ExcelExporter;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookOrderExporter extends ExcelExporter  implements WithMapping
{
    protected $fileName = '图书订单列表.xlsx';

    protected $columns = [
        'id' => 'id',
        'no' => '订单号',
        'buy_id' => '买家昵称',
        'sell_id' => '卖家昵称',
        'pid' => '商品名称',
        'remark' => '买家留言',
        'number' => '购买件数',
        'total' => '总价（易读点）',
        'service_fee' => '服务费（RMB）',
        'address' => '收货地址',
        'paid_at' => '支付时间',
        'payment_method' => '支付方式',
        'payment_no' => '服务费支付平台订单号',
        'closed' => '是否关闭订单',
        'mail_method' => '邮寄方式',
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
            $product->buyMember->nickname,
            $product->sellMember->nickname,
            $product->product->name,
            $product->remark,
            $product->number,
            $product->total,
            $product->service_fee,
            $product->address,
            $product->paid_at,
            $product->payment_method = BookOrder::$paymentMethodMap[$product->payment_method],
            $product->payment_no,
            $product->closed,
            $product->mail_method = BookOrder::$mailMethodMap[$product->mail_method],
            $product->ship_status = BookOrder::$shipStatusMap[$product->ship_status],
            $product->ship_data,
            $product->created_at,
            $product->updated_at,
        ];
    }
}