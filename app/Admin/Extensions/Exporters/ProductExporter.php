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

class ProductExporter extends ExcelExporter  implements WithMapping
{
    protected $fileName = '图书列表.xlsx';

    protected $columns = [
        'id' => 'id',
        'degree_id' => '成色',
        'cate_id' => '图书',
        'member_id' => '所属会员',
        'name' => '书名',
        'pricing' => '定价',
        'price' => '售价',
        'inventory' => '库存',
        'attention' => '关注值',
        'postage' => '邮费说明',
        'service' => '服务费',
        'author' => '作者',
        'press' => '出版社',
        'image' => '图书图片',
        'other' => '其他属性',
        'status' => '图书状态',
        'created_at' => '生成时间',
        'updated_at' => '修改时间',
        'suit_of_class' => '图书套型',
        'suit_number' => '套内几本',
    ];


    public function map($product) : array
    {
        $suit_of_class =  '一本';
        if ($product->suit_of_class == 1) {
            $suit_of_class =  '一本';
        }else if ($product->suit_of_class == 2){
            $suit_of_class =  '一套';
        }
        return [
            $product->id,
            $product->degree->cate_name,
            $product->category->cate_name,
            $product->member->nickname,
            $product->name,
            $product->pricing,
            $product->price,
            $product->inventory,
            $product->attention,
            $product->postage,
            $product->service,
            $product->author,
            $product->press,
            $product->image,
            $product->other,
            $product->status ? '上架中' : '已下架',
            $product->created_at,
            $product->updated_at,
            $product->suit_of_class = $suit_of_class,
            $product->suit_number,
        ];
    }
}