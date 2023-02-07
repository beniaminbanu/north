<?php

use Illuminate\Routing\Router;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@index');

    // Content
    $router->resource('content/tags', PageTagsController::class);
    $router->resource('content/pages', PageController::class);
    $router->resource('content/slides', SlidesController::class);
    $router->resource('content/articles', ArticlesController::class);
    $router->resource('content/services', ServicesController::class);
    $router->resource('content/positions', PositionsController::class);
    $router->resource('content/translations', TranslationController::class);
    $router->resource('content/testimonials', TestimonialsController::class);
    $router->resource('content/articles-category', ArticlesCategoryController::class);
    $router->resource('content/projects-category', ProjectsCategoryController::class);
    $router->resource('content/services-category', ServicesCategoryController::class);

    // Admin
    $router->resource('auth/settings', SettingController::class);
    $router->resource('auth/email-templates', EmailTemplateController::class);

    $router->get('auth/translations_clear', 'TranslationController@clearCache');
});
