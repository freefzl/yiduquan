<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/19 0019
 * Time: 15:08
 */

namespace App\Admin\Controllers;


use App\Models\Product;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function edits()
    {

        /*foreach (Product::find(request('ids')) as $product) {
            $product->cate_id = request('action');
            $product->save();
        }*/

//       return redirect(view('admin.product.edits'));
        return json_encode(request('ids'));
    }
}