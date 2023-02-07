<?php

namespace App\Admin\Controllers;

use App\Models\Testimonial;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;

/**
 * Class TestimonialsController
 * @package App\Admin\Controllers
 */
class TestimonialsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Testimonials';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Testimonial());

        $grid->model()->orderBy('id', 'desc');

        $grid->id('ID')->sortable();
        $grid->translation()->name('Name')->display(function ($value) {
            return $value;
        });
        $grid->translation()->profession('Location')->display(function ($value) {
            return $value;
        });
        $grid->translation()->description('Description')->display(function ($value) {
            return $value;
        });
        $grid->order('Order')->sortable();
        $grid->created_at()->sortable();

        $grid->filter(function (Grid\Filter $filter) {
            $filter->useModal();
            $filter->like('translation.name', 'name');
            $filter->like('translation.profession', 'Profession');
            $filter->like('translation.description', 'Description');
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
        $form = new Form(new Testimonial());

        $form->hidden('locale')->default('ro')->rules('required');
        $form->text('name', 'Name');
        $form->textarea('profession', 'Location');
        $form->textarea('description', 'Description');
        $form->image('image', 'Image')
            ->dir($dir = 'testimonials/')
            ->formName()
            ->options([
                'minSize' => [
                    'width' => '100',
                    'height' => '100'
                ],
            ])
            ->help('Size Of 100 x 100');

        $form->number('order', 'Order');
        $form->switch('status', 'Status')->states([
            'on' => ['value' => Testimonial::STATUS_ON],
            'off' =>  ['value' => Testimonial::STATUS_OFF]
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
