<?php

namespace App\Admin\Controllers;

use CrossTimeTech\Laravel\Translation\Database\Translation;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Support\Facades\Artisan;
use Encore\Admin\Grid;
use Encore\Admin\Form;
use Encore\Admin\Grid\Filter;
use \Illuminate\Support\Str;

/**
 * Class TranslationsController
 *
 * @package App\Admin\Controllers
 */
class TranslationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Texts';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Translation());

        $grid->model()->orderBy('id', 'desc');

        $grid->id('ID')->sortable();
        $grid->group('Group')->sortable();
        $grid->item('Item')->sortable();
        $grid->text('Text')->display(function ($text) {
            return array_key_exists('ro', $text) ? Str::limit($text['ro'], 70) : '';
        });
        $grid->column('created_at')->display(function ($created_at) {
            return date('Y-m-d H:m:s', strtotime($created_at));
        });
        $grid->column('updated_at')->display(function ($updated_at) {
            return date('Y-m-d H:m:s', strtotime($updated_at));
        });

        $grid->filter(function (Filter $filter) {
            $filter->useModal();
            $filter->like('group', 'Group');
            $filter->like('item', 'Item');
            $filter->like('text', 'Text');
            $filter->between('created_at', 'Created At')->datetime();
            $filter->between('updated_at', 'Updated At')->datetime();
        });

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
        $form = new Form(new Translation());

        $form->hidden('namespace')->default('*');
        $form->text('group', 'Group')->rules('required');
        $form->text('item', 'Item')->rules('required');
        $form->embeds('text', 'Text', function ($form) {
            $form->text('ro')->rules('required');
        });

        $form->saved(function () {
            Artisan::call('cache:clear');
        });

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
        });

        return $form;
    }
}
