<?php

namespace App\Admin\Controllers;

use App\Models\Setting;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Artisan;
use Encore\Admin\Controllers\AdminController;

class SettingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Settings';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Setting());

        $grid->model()->orderBy('id', 'desc');

        $grid->id('ID')->sortable();
        $grid->key('Key')->sortable();
        $grid->column('value', 'Value')->sortable();
        $grid->status('Status')->value(function ($status) {
            if ($status === 'active') {
                return '<i class="fa fa-check" style="color: green"></i>';
            }
            return '<i class="fa fa-times" style="color: red"></i>';
        })->sortable();

        $grid->filter(function ($filter) {
            $filter->like('key', 'Key');
            $filter->like('value', 'Value');
            $filter->is('status', 'Status')->select([
                Setting::STATUS_ON => 'Active',
                Setting::STATUS_OFF => 'Inactive'
            ]);
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
        $form = new Form(new Setting());

        $form->text('key', 'Key')->rules('required');
        $form->textarea('value', 'Value')->rules('required');
        $form->switch('status', 'Status')->states([
            'on' => ['value' => Setting::STATUS_ON],
            'off' =>  ['value' => Setting::STATUS_OFF]
        ]);

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
