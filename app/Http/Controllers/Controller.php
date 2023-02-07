<?php

namespace App\Http\Controllers;

use Encore\Admin\Form;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

/**
 * Class Controller
 *
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string|null $image
     * @return string
     */
    public static function displayImage(string $image = null)
    {
        if (empty($image)) {
            return trans('admin.not_uploaded');
        }

        return sprintf('<img style="max-width: 100px; max-height: 100px;" src="%s?%s"/>', asset('upload/' . $image), time());
    }

    /**
     * @param Form $form
     */
    protected function saveTranslationSlug(Form $form)
    {
        $form->input('translations', collect($form->input('translations'))->map(function (array $item) {
            $item['slug'] = Str::slug($item['slug'] ?: $item['name'], ' ');
            return $item;
        })->toArray());
    }

    /**
     * Move multiple uploaded images in one call. The elements of images parameter
     * contains a set of specific keys: dir, translation_key, image_key.
     *
     * @param Form $form
     * @param array $images
     * @throws \Exception
     */
    protected function moveUploadedImages(Form $form, $images = [])
    {
        foreach ($images as $image) {

            if (!isset($image['dir'], $image['translation_key'], $image['image_key'])) {
                throw new \Exception(
                    'The elements of images parameter contains a set of specific keys: dir, translation_key, image_key.'
                );
            }

            $this->moveUploadedImage($form, $image['dir'], $image['translation_key'], $image['image_key']);
        }
    }

    /**
     * @param Form $form
     * @param string $dir
     * @param string $translation_key
     * @param string $image_key
     * @return boolean
     */
    protected function moveUploadedImage(
        Form $form,
        string $dir,
        string $translation_key = 'name',
        string $image_key = 'image'
    ) {
        $disk = Storage::disk('admin');
        $image = $form->$image_key;

        if (empty($image) || is_string($image)) {
            return false;
        }

        $file = $dir . Str::slug($this->getUploadedImageName($form, $translation_key)) . '.' . $image->clientExtension();

        if ($disk->exists($file)) {
            $disk->delete($file);
        }

        $disk->move($form->model()->$image_key, $file);

        $form->model()->$image_key = $file;

        return $form->model()->save();
    }

    /**
     * @param Form $form
     * @param string $dir
     * @param string $image_key
     * @param string $cropped_image_key
     * @return bool
     */
    protected function saveCroppedImage(
        Form $form,
        string $dir,
        string $image_key = 'image',
        string $cropped_image_key = 'cropped_image'
    ) {
        return false;
    }

    /**
     * @param Form $form
     * @param string $key
     * @return string
     */
    protected function getUploadedImageName(Form $form, string $key = 'name')
    {
        if (is_null($form->translations)) {

            if ($name = $form->$key) {

                return implode(' ', [
                    $name,
                    $form->model()->id
                ]);
            }

            return (string)$form->model()->id;
        }

        return implode(' ', array_filter([
            self::getTranslationNameWithFallback($form->translations, $key),
            $form->model()->id
        ]));
    }

    /**
     * @param array $translations
     * @param string $key
     * @return mixed
     */
    public static function getTranslationNameWithFallback(array $translations = [], string $key = 'name')
    {
        $locale = config('app.locale');
        $fallback_locale = config('app.fallback_locale');

        $name = array_reduce($translations, function ($initial, $translation) use ($key, $locale) {
            return $translation['locale'] == $locale ? $translation[$key] : $initial;
        });

        $fallback_name = array_reduce($translations, function ($initial, $translation) use ($key, $fallback_locale) {
            return $translation['locale'] == $fallback_locale ? $translation[$key] : $initial;
        });

        return $name ?: $fallback_name;
    }
}
