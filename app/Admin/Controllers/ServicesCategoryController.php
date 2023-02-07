<?php

namespace App\Admin\Controllers;

use App\Models\Page;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;

/**
 * Class ServicesCategoryController
 * @package App\Admin\Controllers
 */
class ServicesCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Services Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ServiceCategory());

        $grid->model()->orderBy('id', 'desc');

        $grid->id('ID')->sortable();
        $grid->image('Icon')->display(function ($icon) {
            return Controller::displayImage($icon);
        });
        $grid->translation()->name('Name')->value(function ($value) {
            return $value;
        });
        $grid->order('Order')->sortable();
        $grid->order_home('Order Home')->sortable();
        $grid->status('Status')->display(function ($value) {
            return $value == ServiceCategory::ENUM_ACTIVE ? 'Active' : 'Inactive';
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
        $form = new ServiceCategory();

        $form->hidden('locale')->default('ro')->rules('required');
        $form->text('name', 'Name');
        $form->text('slug', 'Slug');
        $form->text('seo_title', 'Seo Title');
        $form->text('seo_keywords', 'Seo Keywords');
        $form->text('seo_description', 'Seo Description');
        $form->textarea('short_description', 'Short Description');
        $form->editor('description', 'Description');
        $form->image('image', 'Icon')
            ->dir($dir = 'services/icons/')
            ->help('Size Of 42 x 42')
            ->uniqueName();
        $form->number('order', 'Order');
        $form->number('order_home', 'Order Home');
        $form->switch('is_home', 'Is Home')->states([
            'on'  => ['value' => 'active'],
            'off' => ['value' => 'inactive'],
        ]);
        $form->select('page_id', 'Menu')->options(
            ['' => 'none'] +
                Page::active()
                ->translated()
                ->withTranslation()
                ->get()
                ->pluck('translation.name', 'id')
                ->toArray()
        );
        $form->switch('status', 'Status')->states([
            'on'  => ['value' => ServiceCategory::ENUM_ACTIVE],
            'off' => ['value' => ServiceCategory::ENUM_INACTIVE]
        ]);

        $form->saved(function (Form $form) use ($dir) {
            $this->moveUploadedImage($form, $dir);
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
