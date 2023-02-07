<?php

namespace App\Admin\Controllers;

use App\Models\Page;
use App\Models\PageTag;

use Illuminate\Support\Arr;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class PageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pages';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Page());

        $grid->model()->orderBy('id', 'desc');

        $grid->id('ID')->sortable();
        $grid->translation()->name('Name')->sortable();
        $grid->tags('Tags')->display(function ($tags) {
            $result = '';
            foreach ($tags as $tag) {
                $result .= '<span class="label label-success" style="margin-right: 5px;">' . $tag['name'] . '</span>';
            }
            return $result;
        });
        $grid->column('parent.translation', 'Parent')->display(function ($translation) {
            return Arr::get($translation, 'name', '-');
        });
        $grid->order('Order')->sortable();
        $grid->is_searchable('Searchable')->display(function ($status) {
            return '<i class="fa fa-' . Arr::get([1 => 'check', 0 => 'times'], $status) . '" style="color:' . Arr::get([1 => 'green', 0 => 'red'], $status) . '"></i>';
        })->sortable();
        $grid->status('Status')->display(function ($status) {
            return '<i class="fa fa-' . Arr::get([Page::ENUM_ACTIVE => 'check', Page::ENUM_INACTIVE => 'times'], $status) . '" style="color:' . Arr::get([Page::ENUM_ACTIVE => 'green', Page::ENUM_INACTIVE => 'red'], $status) . '"></i>';
        })->sortable();

        $grid->filter(function (Grid\Filter $filter) {
            $filter->useModal();
            $filter->like('translation.name', 'Name');
            $filter->is('status', 'Status')->select([
                'active'   => 'Active',
                'inactive' => 'Inactive'
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
        $form = new Form(new Page());

        $form->hidden('translation.locale')->default('ro')->rules('required');
        $form->text('translation.name', 'Name')->rules('required');
        $form->text('translation.slug', 'Slug');
        $form->text('translation.seo_title', 'Seo Title');
        $form->text('translation.seo_keywords', 'Seo Keywords');
        $form->text('translation.seo_description', 'Seo Description');
        $form->text('translation.heading', 'Heading');
        $form->text('translation.link', 'Link');
        $form->textarea('translation.short_description', 'Short Description');
        $form->editor('translation.description', 'Description');
        $form->image('image', "Image")
            ->dir('pages/')
            ->options()
            ->help('Size Of 550 x 350');
        $form->switch('is_searchable', 'Is Searchable');
        $form->switch('status', 'Status')->states([
            'on'  => ['value' => 'active'],
            'off' => ['value' => 'inactive'],
        ]);
        $form->number('Order')->rules('integer|min:0');
        $form->select('parent_id', 'Parent')->options(
            ['' => 'None'] +
                Page::active()
                ->translated()
                ->withTranslation()
                ->get()
                ->pluck('translation.name', 'id')
                ->toArray()
        );
        $form->multipleSelect('tags', 'Tags')->options(
            PageTag::all()->pluck('name', 'id')
        );

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
        });

        return $form;
    }
}
