<?php

use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

if (!function_exists('localization_url')) {

    /**
     * @param array $slugs
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function localization_url(...$slugs)
    {
        $locale = app()->getLocale();

        $segments = collect([
            Localization::getRoutePrefix()
        ]);

        collect($slugs)
            ->map(function ($slug) use ($locale) {
                return Str::slug($slug, '-', $locale);
            })
            ->each(function ($slug) use ($segments) {
                $segments->push($slug);
            });

        return url($segments->filter()->implode('/'));
    }
}

if (!function_exists('reduce_model_categories_to_css_classes')) {

    /**
     * @param Model $model
     * @return string
     */
    function reduce_model_categories_to_css_classes(Model $model)
    {
        if (!method_exists($model, 'categories')) {
            return '';
        }

        return $model->categories->reduce(function ($carry, $category) {
            return $carry . ' ' . Str::slug($category->getTranslation()->name);
        });
    }
}

if (!function_exists('page')) {

    /**
     * @param string $controller
     * @return Page|null
     */
    function page(string $controller = '')
    {
        static $pages = [];

        if (!array_key_exists($controller, $pages)) {

            if (
                $page = Page::whereHandlerController($controller)
                ->translated()
                ->withTranslation()
                ->with(['parent' => function ($q) {
                    $q->active()
                        ->translated()
                        ->withTranslation();
                }])
                ->first()
            ) {
                $pages[$controller] = $page;
            }
        }

        return Arr::get($pages, $controller, null);
    }
}

if (!function_exists('styleAttrImage')) {

    /**
     * @param Model $model
     * @param string $image_key
     * @param bool $style
     * @return null|string
     */
    function styleAttrImage(Model $model, string $image_key = 'image', bool $style = true)
    {
        $image = $model->$image_key;

        if (empty($image)) {
            return null;
        }

        if (!$style) {
            return "background: url('/upload/$image') no-repeat center center;";
        }

        return "style=\"background: url('/upload/$image') no-repeat center center;\"";
    }
}

if (!function_exists('renderServiceDescription')) {

    /**
     * @param Service $service
     * @return string
     */
    function renderServiceDescription(Service $service)
    {
        $description = array();

        $descriptions = explode(
            "\n\r",
            $service->getTranslation()->description
        );

        $first = array_shift($descriptions);
        $last = array_pop($descriptions);
        $checks = array_filter(explode("\n", $service->getTranslation()->list));

        array_push($description, sprintf(
            '<p class="description">%s</p>',
            $first
        ));

        if ($service->image) {
            array_push($description, sprintf(
                '<div class="image"><img src="%s" alt="%s"></div>',
                $service->imagePath(),
                $service->getTranslation()->name
            ));
        }

        foreach ($descriptions as $item) {
            array_push($description, sprintf(
                '<p class="description">%s</p>',
                $item
            ));
        }

        if ($checks) {

            $checksList = ['<ul>'];

            foreach ($checks as $check) {
                $checksList[] = sprintf('<li><i class="far fa-check-circle"></i><span>%s</span></li>', $check);
            }

            $checksList[] = '</ul>';

            array_push($description, implode('', $checksList));
        }

        array_push($description, sprintf(
            '<p class="description">%s</p>',
            $last
        ));

        return implode("\n\r", $description);
    }
}

if (!function_exists('settings')) {

    /**
     * Get specified setting value.
     *
     * @param $key
     *
     * @return array|null|string
     */
    function settings($key)
    {
        static $settings;

        if (is_null($settings)) {
            $settings = Cache::remember('settings', 24 * 60, function () {
                return Arr::pluck(Setting::active()->get()->toArray(), 'value', 'key');
            });
        }

        if (empty($settings[$key])) {
            return null;
        }

        return (is_array($key)) ? Arr::only($settings, $key) : $settings[$key];
    }
}

if (!function_exists('swal')) {

    /**
     * Flash a sweet alert messaage bag to session.
     *
     * @param string $title
     * @param string $type
     * @param string $message
     *
     * @return string
     */
    function swal($message = '', $title = '', $type = '')
    {
        $toastr = new \Illuminate\Support\MessageBag(get_defined_vars());

        \Illuminate\Support\Facades\Session::flash('swal', $toastr);
    }
}

if (!function_exists('swal_success')) {

    /**
     * Flash a sweet alert success messaage bag to session.
     *
     * @param string $message
     * @param string $title
     *
     * @return string
     */
    function swal_success($message = '', $title = '')
    {
        swal($message, $title, 'success');
    }
}

if (!function_exists('swal_error')) {

    /**
     * Flash a sweet alert error messaage bag to session.
     *
     * @param string $message
     * @param string $title
     *
     * @return string
     */
    function swal_error($message = '', $title = '')
    {
        swal($message, $title, 'error');
    }
}

if (!function_exists('swal_warning')) {

    /**
     * Flash a sweet alert warning messaage bag to session.
     *
     * @param string $message
     * @param string $title
     *
     * @return string
     */
    function swal_warning($message = '', $title = '')
    {
        swal($message, $title, 'warning');
    }
}

if (!function_exists('swal_info')) {

    /**
     * Flash a sweet alert info messaage bag to session.
     *
     * @param string $message
     * @param string $title
     *
     * @return string
     */
    function swal_info($message = '', $title = '')
    {
        swal($message, $title, 'info');
    }
}

if (!function_exists('swal_question')) {

    /**
     * Flash a sweet alert question messaage bag to session.
     *
     * @param string $message
     * @param string $title
     *
     * @return string
     */
    function swal_question($message = '', $title = '')
    {
        swal($message, $title, 'question');
    }
}
