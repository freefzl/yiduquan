<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5 0005
 * Time: 15:03
 */

function upload_img($file)
{
    $url_path = storage_path('app/public/images/');
    $rule = ['jpg', 'png', 'gif'];
    if ($file->isValid()) {
        $clientName = $file->getClientOriginalName();
        $tmpName = $file->getFileName();
        $realPath = $file->getRealPath();
        $entension = $file->getClientOriginalExtension();
        if (!in_array($entension, $rule)) {
            return '图片格式为jpg,png,gif';
        }
//        $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;
        $path = $file->move($url_path, $clientName);
        $namePath = $url_path . '/' . $clientName;
        return $path;
    }
}

