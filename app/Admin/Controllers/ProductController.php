<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Degree;
use App\Models\Member;
use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '图书';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('Id'));
        $grid->column('degree_id', __('成色'))->display(function ($degree_id) {
            return Degree::find($degree_id)->cate_name;
        });
        $grid->column('cate_id', __('分类'))->display(function ($cate_id) {
            return Category::find($cate_id)->cate_name;
        });
        $grid->column('member.nickname', __('所属会员'));
        $grid->column('name', __('书名'));
        $grid->column('pricing', __('定价'));
        $grid->column('price', __('售价'));
        $grid->column('inventory', __('库存'));
        $grid->column('attention', __('关注值'));
        $grid->column('postage', __('邮寄说明'));
        $grid->column('service', __('服务费'));
        $grid->column('author', __('作者'));
        $grid->column('press', __('出版社'));
        $grid->column('image', __('图书图片'))->display(function ($image) {
            return "<img style='width: 50px;' src=".env('IMG_URL').$image.">";
        });
        $grid->column('created_at', __('生成时间'));
        $grid->column('updated_at', __('修改时间'));
//        $grid->column('status', __('图书状态'))->using([0 => '未上架', 1 => '已上架']);
        $grid->column('status', __('是否上架'))->bool();

        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('name', '书名');
            $filter->like('author', '作者');
            $filter->like('press', '出版社');
            $filter->between('created_at', '生成时间')->datetime();


        });

        $grid->actions(function ($actions) {

            // 去掉删除
            //$actions->disableDelete();

            // 去掉编辑
            $actions->disableEdit();

            // 去掉查看
            //$actions->disableView();
        });
        return $grid;
    }

    public function show($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($id));
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('degree_id', __('成色分类'))->as(function ($degree_id) {
            return Degree::find($degree_id)->cate_name;
        });
        $show->field('cate_id', __('图书分类'))->as(function ($cate_id) {
            return Category::find($cate_id)->cate_name;
        });
        $show->field('name', __('书名'));
        $show->field('pricing', __('定价'));
        $show->field('price', __('售价'));
        $show->field('inventory', __('库存'));
        $show->field('attention', __('关注值'));
        $show->field('postage', __('邮费说明'));
        $show->field('service', __('服务费'));
        $show->field('author', __('作者'));
        $show->field('press', __('出版社'));
        $show->field('image', __('图书图片'))->image();
        $show->field('other', __('其他'));
        $show->field('created_at', __('生成时间'));
        $show->field('updated_at', __('修改时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());

        $form->number('degree_id', __('成色分类'));
        $form->number('cate_id', __('图书分类'));
        $form->text('name', __('书名'));
        $form->decimal('pricing', __('定价'))->default(0.00);
        $form->decimal('price', __('售价'))->default(0.00);
        $form->number('inventory', __('库存'))->default(1);
        $form->number('attention', __('关注值'));
        $form->text('postage', __('邮费说明'));
        $form->decimal('service', __('服务费'))->default(0.00);
        $form->text('author', __('作者'));
        $form->text('press', __('出版社'));
        $form->image('image', __('图书图片'));
        $form->textarea('other', __('其他'));

        return $form;
    }
}