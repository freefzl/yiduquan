<?php

namespace App\Admin\Controllers;

use App\Models\WelfareType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;

class WelfareTypeController extends Content
{
    use HasResourceActions;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '福利商品类型';

    /**
     * 首页
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content->title('福利商品类型')
            ->description('列表')
            ->row(function (Row $row) {
                // 显示分类树状图
                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('welfare-types'));
                    $form->select('pid', __('父级'))->options(WelfareType::selectOptions());
                    $form->text('cate_name', __('分类名称'))->required();
                    $form->number('sort', __('排序'))->default(99)->help('越小越靠前');
                    $form->hidden('_token')->default(csrf_token());
                    $column->append((new Box(__('添加分类'), $form))->style('success'));
                });

            });

    }

    /**
     * 树状视图
     * @return Tree
     */
    protected function treeView()
    {
        return  WelfareType::tree(function (Tree $tree){
            $tree->disableCreate(); // 关闭新增按钮
            $tree->branch(function ($branch) {
                return "<strong>{$branch['cate_name']}</strong>"; // 标题添加strong标签
            });
        });
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->title($this->title)
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));

    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WelfareType());

        $grid->column('id', __('Id'));
        $grid->column('pid', __('Pid'));
        $grid->column('cate_name', __('Cate name'));
        $grid->column('sort', __('Sort'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(WelfareType::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('pid', __('Pid'));
        $show->field('cate_name', __('Cate name'));
        $show->field('sort', __('Sort'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WelfareType());

        $form->number('pid', __('Pid'));
        $form->text('cate_name', __('Cate name'));
        $form->number('sort', __('Sort'));

        return $form;
    }
}
