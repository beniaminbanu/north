<?php

namespace App\Admin\Controllers;

use App\Models\Slide;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;

/**
 * Class RealisationsController
 *
 * @package App\Admin\Controllers
 */
class SlidesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Slides';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Slide());

        $grid->model()->orderBy('id', 'desc');

        $grid->id('ID')->sortable();
        $grid->translation()->name('Name')->display(function ($value) {
            return $value;
        });
        $grid->translation()->description('Description')->display(function ($value) {
            return $value;
        });
        $grid->order('Order')->sortable();
        $grid->image('Image')->display(function ($image) {
            if (empty($image)) {
                return 'No Image Found';
            }
            return sprintf("<img src='%s' height='100px'>", asset('upload') . DIRECTORY_SEPARATOR . $image);
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
        $form = new Form(new Slide());

        $form->hidden('locale')->default('ro')->rules('required');
        $form->text('name', 'Name')->rules('required');
        $form->textarea('description', 'Description');
        $form->image('image', 'Image')
            ->dir($dir = 'slides/')
            ->formName()
            ->options([
                'minSize' => [
                    'width' => '1920',
                    'height' => '750'
                ],
            ])
            ->help('Size Of 1920 x 750');
        $form->number('order', 'Order');
        $form->switch('status', 'Status')->states([
            'on'  => ['value' => Slide::STATUS_ON],
            'off' => ['value' => Slide::STATUS_OFF]
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
