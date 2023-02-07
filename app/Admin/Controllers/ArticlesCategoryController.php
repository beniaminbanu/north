<?php

namespace App\Admin\Controllers;

use App\Models\ArticleCategory;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;

/**
 * Class ArticlesCategoryController
 * @package App\Admin\Controllers
 */
class ArticlesCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Articles Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleCategory());

        $grid->model()->orderBy('id', 'desc');

        $grid->id('ID')->sortable();
        $grid->translation()->name('Name')->display(function ($value) {
            return $value;
        });
        $grid->order('Order')->sortable();
        $grid->status('Status')->display(function ($value) {
            return $value == ArticleCategory::ENUM_ACTIVE ? 'active' : 'inactive';
        });
        $grid->created_at()->sortable();

        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ArticleCategory());

        $form->hidden('locale')->default('ro')->rules('required');
        $form->text('name', 'Name');
        $form->text('slug', 'Slug');
        $form->text('seo_title', 'Title');
        $form->text('seo_keywords', 'Seo Keywords');
        $form->text('seo_description', 'Seo Description');
        $form->number('order', 'Order');
        $form->switch('status', 'Status')->states([
            'on'  => ['value' => ArticleCategory::ENUM_ACTIVE],
            'off' => ['value' => ArticleCategory::ENUM_INACTIVE]
        ]);

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
        });

        return $form;
    }
}
