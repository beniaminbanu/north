<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;

/**
 * Class ArticlesController
 * @package App\Admin\Controllers
 */
class ArticlesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Articles';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());

        $grid->model()->orderBy('id', 'desc');

        $grid->id('ID')->sortable();
        $grid->image('Image')->display(function ($image) {
            if (empty($image)) {
                return 'No Image Found';
            }
            return sprintf("<img src='%s' height='50px'>", asset('upload') . DIRECTORY_SEPARATOR . $image);
        });
        $grid->translation()->name('Name')->display(function ($value) {
            return $value;
        });
        $grid->order('Order')->sortable();
        $grid->is_home('Is Home')->display(function ($value) {
            return $value == Article::ENUM_ACTIVE ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
        })->default(0)->sortable();
        $grid->status('Status')->display(function ($status) {
            return $status == Article::ENUM_ACTIVE ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
        })->sortable();
        $grid->created_at('Created At')->sortable();

        $grid->filter(function ($filter) {
            $filter->useModal();
            $filter->like('translation.name', 'Name');
            $filter->is('status', 'Status')->select([
                Article::ENUM_ACTIVE   => 'Active',
                Article::ENUM_INACTIVE => 'Inactive'
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
        $form = new Form(new Article());

        $form->hidden('translation.locale')->default('ro')->rules('required');
        $form->text('translation.name', 'Name')->rules('required');
        $form->text('translation.slug', 'Slug')->rules('required');
        $form->text('translation.seo_title', 'Seo Title')->rules('required');
        $form->text('translation.seo_keywords', 'Seo Keywords')->rules('required');
        $form->text('translation.seo_description', 'Seo Description')->rules('required');
        $form->textarea('translation.short_description', 'Short Description')->rules('required');
        $form->editor('translation.description', 'Description')->rules('required');
        $form->multipleSelect('categories', 'Categories')->options(
            ArticleCategory::active()
                ->translated()
                ->withTranslation()
                ->get()
                ->pluck('translation.name', 'id')
                ->toArray()
        )->rules('required');
        $form->image('image', 'Image')
            ->dir('team/')
            ->options([
                'minSize' => [
                    'width' => '1590',
                    'height' => '1064'
                ],
            ])
            ->help('Size of 370 x 250')->rules('required');
        $form->datetime('published_at', 'Published At')->rules('required');
        $form->number('order', 'Order')->default(0)->required();
        $form->switch('is_home', 'Is Home')->states([
            'on'  => ['value' => Article::ENUM_ACTIVE],
            'off' => ['value' => Article::ENUM_INACTIVE]
        ])->default('off');
        $form->switch('status', 'Status')->states([
            'on'  => ['value' => Article::ENUM_ACTIVE],
            'off' => ['value' => Article::ENUM_INACTIVE]
        ])->default('off');

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
        });

        return $form;
    }
}
