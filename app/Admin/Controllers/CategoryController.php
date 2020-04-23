<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;

class CategoryController extends Content
{
    use HasResourceActions;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '图书分类';


    /**
     * 首页
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content->title('图书分类')
            ->description('列表')
            ->row(function (Row $row) {
                // 显示分类树状图
                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('categories'));
                    $form->select('pid', __('父级'))->options(Category::selectOptions());
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
        return  Category::tree(function (Tree $tree){
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
        $grid = new Grid(new Category());

        $grid->column('id', __('Id'));
        $grid->column('parent_id', __('父级id'));
        $grid->column('name', __('分类名称'));
        $grid->column('created_at', __('生成时间'));
        $grid->column('updated_at', __('修改时间'));

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
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parent_id', __('Parent id'));
        $show->field('name', __('Name'));
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

        $form = new Form(new Category());

        $form->tools(function (Form\Tools $tools) {
            // 去掉`列表`按钮
//            $tools->disableList();
            // 去掉`删除`按钮
//            $tools->disableDelete();
            // 去掉`查看`按钮
            $tools->disableView();

        });

        $form->number('id', __('id'));
        $form->select('pid', __('父级id'))->options(Category::selectOptions());
        $form->text('cate_name', __('分类名称'))->required();
        $form->number('sort', __('排序'))->default(99)->help('越小越靠前');

        $form->footer(function ($footer) {

            // 去掉`重置`按钮
            //$footer->disableReset();

            // 去掉`提交`按钮
            //$footer->disableSubmit();

            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            //$footer->disableEditingCheck();

            // 去掉`继续创建`checkbox
            //$footer->disableCreatingCheck();

        });

        return $form;
    }
}
