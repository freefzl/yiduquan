<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\BatchAction;

class EditPost extends BatchAction
{
    /*protected $action;

    public function __construct($action = 1)
    {
        $this->action = $action;
    }*/

    public function script()
    {
//        return view('admin.product.edits');

        return <<<EOT

$('{$this->getElementClass()}').on('click', function() {

    $.ajax({
        method: 'post',
        url: '{$this->resource}/edits',
        data: {
            _token:LA.token,
            ids: $.admin.grid.selected(),
        },
        success: function (data) {
//            $.pjax.reload('#pjax-container');
//            toastr.success('操作成功');
           
            window.location.replace('/admin/products/myedit?ids='+data);
        }
    });
});

EOT;

    }
}