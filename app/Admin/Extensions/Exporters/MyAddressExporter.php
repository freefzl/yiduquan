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

class MyAddressExporter extends ExcelExporter  implements WithMapping
{
    protected $fileName = '我的地址列表.xlsx';

    protected $columns = [
        'id' => 'id',
        'mid' => '会员昵称',
        'name' => '姓名',
        'mobile' => '手机号',
        'province' => '省',
        'city' => '市',
        'area' => '区',
        'address' => '详情地址',
        'longitude' => '经度',
        'latitude' => '纬度',
        'default' => '默认使用',
        'created_at' => '生成时间',
        'updated_at' => '修改时间',

    ];


    public function map($product) : array
    {
        return [
            $product->id,
            $product->member->nickname,
            $product->name,
            $product->mobile,
            $product->province,
            $product->city,
            $product->area,
            $product->address,
            $product->longitude,
            $product->latitude,
            $product->default ? '使用' : '未使用',
            $product->created_at,
            $product->updated_at,
        ];
    }
}