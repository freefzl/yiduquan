<?php

namespace App\Services\Product\Enums;

class SuitOfStatus
{
    const SUIT_OF_STATUS_1 = 1; // 一本
    const SUIT_OF_STATUS_2 = 2; // 一套

    /**
     * 是否存在于数组之内
     *
     * @param $value
     * @return bool
     */
    public static function inArray($value)
    {
        foreach (static::all() as $item) {
            if ($item['type'] == $value) {
                return true;
            }
        }
        return false;
    }

    /**
     * 列表
     *
     * @return array
     */
    public static function all()
    {
        return [
            [
                'name' => static::name(static::SUIT_OF_STATUS_1),
                'type' => static::SUIT_OF_STATUS_1,
            ],
            [
                'name' => static::name(static::SUIT_OF_STATUS_2),
                'type' => static::SUIT_OF_STATUS_2,
            ],

        ];
    }

    /**
     * 名称
     *
     * @param $type
     * @return string
     */
    public static function name($type)
    {
        switch ($type) {
            case static::SUIT_OF_STATUS_1:
                return '一本';
                break;
            case static::SUIT_OF_STATUS_2:
                return '一套';
                break;
        }
        return '未知';
    }
}
