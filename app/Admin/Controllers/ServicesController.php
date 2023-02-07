<?php

namespace App\Admin\Controllers;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Arr;

/**
 * Class ServicesController
 *
 * @package App\Admin\Controllers
 */
class ServicesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Services';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Service());

        $grid->model()->with('categories.translation');

        $grid->id('ID')->sortable();
        $grid->image('Image')->display(function ($image) {
            if (empty($image)) {
                return 'Image Not Found';
            }
            return sprintf("<img src='%s' height='50px'>", asset('upload') . DIRECTORY_SEPARATOR . $image);
        });
        $grid->translation()->name('Name')->display(function ($value) {
            return $value;
        });
        $grid->categories()->display(function ($categories) {
            return collect($categories)->map(function ($category) {
                return sprintf(
                    '<span class="label label-success" style="margin-right: 5px;">%s</span>',
                    Arr::get($category, 'translation.name', '-')
                );
            })->implode(' ');
        });
        $grid->footer_order('Footer Order')->sortable();
        $grid->is_footer('Is Footer')->display(function ($status) {
            return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
        })->sortable();

        $grid->is_home('Is Home')->display(function ($status) {
            return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
        })->sortable();
        $grid->is_request('Is Request Service')->display(function ($status) {
            return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
        })->sortable();
        $grid->order('Order')->sortable();
        $grid->status('Status')->display(function ($status) {
            return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
        })->sortable();
        $grid->created_at('Created At')->sortable();

        $grid->filter(function ($filter) {
            $filter->useModal();
            $filter->like('translation.name', 'Name');
            $filter->is('status', 'Status')->select([
                Service::STATUS_ON => 'Active',
                Service::STATUS_OFF => 'Inactive'
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
        $form = new Form(new Service());

        $form->hidden('locale')->default('ro')->rules('required');
        $form->text('name', 'Name')->rules('required');
        $form->text('slug', 'Slug')->rules('required');
        $form->textarea('short_description', 'Short Description');
        $form->textarea('description', 'Description');
        $form->textarea('list', 'List')->help('Each element must be a new line.');
        $form->image('image', 'Image')
            ->dir('services/')
            ->options()
            ->help('Size Of 550 x 350');
        $form->number('footer_order', 'Footer Order');
        $form->switch('is_home', 'Is Home');
        $form->switch('is_footer', 'Is Footer');
        $form->switch('is_request', 'Is Request');
        $form->number('order', 'Order');
        $form->switch('status', 'Status')->states([
            'on' => ['value' => Service::STATUS_ON],
            'off' =>  ['value' => Service::STATUS_OFF]
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
