<?php

namespace App\Admin\Controllers;

use App\Modules\Mailer\EmailTemplate;

use Encore\Admin\Grid;
use Encore\Admin\Form;
use Encore\Admin\Controllers\AdminController;

/**
 * Class EmailTemplateController
 *
 * @package App\Admin\Controllers
 */
class EmailTemplateController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Email Templates';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmailTemplate());

        $grid->model()->orderBy('id', 'desc');

        $grid->id('ID')->sortable();
        $grid->template('template')->sortable();
        $grid->subject('Subject')->sortable();
        $grid->from_name('Sender Name')->sortable();
        $grid->from_address('Sender Address')->sortable();
        $grid->updated_at('Updated At')->sortable();
        $grid->extend('Extend Layout')->disk_free_space(function ($extended) {
            return $extended === EmailTemplate::EXTEND_ON ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
        })->sortable();
        $grid->status('Status')->display(function ($status) {
            return $status === EmailTemplate::STATUS_ON ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
        })->sortable();

        $grid->filter(function ($filter) {
            $filter->like('template', 'Template');
            $filter->like('subject', 'Subject');
            $filter->is('extend', 'Extend Layout')->select([
                EmailTemplate::EXTEND_ON => 'Yes',
                EmailTemplate::EXTEND_OFF => 'No'
            ]);
            $filter->is('status', 'Status')->select([
                EmailTemplate::STATUS_ON => 'Active',
                EmailTemplate::STATUS_OFF => 'Inactive'
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
        $form = new Form(new EmailTemplate());

        $form->hidden('locale')->default('ro')->rules('required');
        $form->text('template', 'Template')->rules('required');
        $form->text('subject', 'Subject')->rules('required');
        $form->text('from_name', 'Sender Name');
        $form->text('from_address', 'Sender Address');
        $form->switch('extend', 'Extend Layout')->states([
            'on' => ['value' => EmailTemplate::EXTEND_ON],
            'off' => ['value' => EmailTemplate::EXTEND_OFF]
        ]);
        $form->switch('status', 'Status')->states([
            'on' => ['value' => EmailTemplate::STATUS_ON],
            'off' => ['value' => EmailTemplate::STATUS_OFF]
        ]);
        $form->editor('content', 'Content');

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
        });

        return $form;
    }
}
