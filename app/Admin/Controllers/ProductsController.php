<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProductsController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商品列表')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('修改产品')
            ->description('修改产品信息')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('创建商品')
            ->body($this->form());
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        // 创建一个输入框 第一个参数title是模型的字段名称，第二个是字段的描述
        $form->text('title', '产品名称')->rules('required');

        // 创建一个选择图片框
        $form->image('image', '产品图片')->rules('required|image'); // 创建一个富文本编辑器
        $form->editor('description', '产品描述')->rules('required');
        $form->radio('on_sale', '上架')->options(['1'=>'是','0'=>'否'])->default(0);
        $form->hasMany('skus', 'SKU 列表', function (Form\NestedForm $form){
            $form->text('product_code','sku')->rules('required');
            $form->text('description','描述')->rules('required');
            $form->text('price', '单价')->rules('required|numeric|min:0.1');
            $form->text('cost', '成本')->rules('required|numeric|min:0.1');
            $form->text('stock','库存')->rules('required|integer|min:0');
        });

        // 将传入的skus数据放到collect中，并且数据中的_remove_等于0（等于1则表示删除），在从其中取出最小值
        $form->saving(function (Form $form){
            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME,0)->min('price') ?: 0.1;
        });
        return $form;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);
        $grid->id('ID')->sortable();
        $grid->title('商品名称');
        $grid->on_sale('已上架')->display(function ($value){
            return $value ? '是' : '否';
        });
        $grid->rating('评分');
        $grid->sold_count('销量');
        $grid->review_count('评论数');
        $grid->price('价格')->display(function ($value){
            return '￥'. $value;
        });

        $grid->actions(function ($actions){
            $actions->disableDelete();
            $actions->disableView();
        });

        $grid->tools(function ($tools){
            $tools->batch(function ($batch){
               $batch->disableDelete();
            });
        });

        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

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
        $show = new Show(Product::findOrFail($id));

        $show->id('Id');
        $show->title('Title');
        $show->description('Description');
        $show->image('Image');
        $show->on_sale('On sale');
        $show->rating('Rating');
        $show->sold_count('Sold count');
        $show->review_count('Review count');
        $show->price('Price');
        $show->cost('Cost');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }
}
