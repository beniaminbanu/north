<?php

namespace App\Admin\Controllers;

use App\Models\PageTag;
use App\Http\Controllers\Controller;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;

class PageTagsController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Page Tags';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(PageTag::class, function (Grid $grid) {
            $grid = new Grid(new PageTag());

            $grid->model()->orderBy('id', 'desc');

            $grid->id('ID')->sortable();
            $grid->name('Name')->sortable();
            $grid->created_at("Created At")->sortable();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->like('name', 'Name');
            });

            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            return $grid;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PageTag());

        $form->text('name', 'Name')->rules('required');

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
        });

        return $form;
    }
}
