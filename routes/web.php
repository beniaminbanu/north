<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Packages\Localization\Facades\Localization;
use App\Packages\Sluggable\Routing\Facades\Sluggable;

Route::group([
    'prefix'     => Localization::getRoutePrefix(),
    'middleware' => [
        /* 'allow.development.ips', */
        'localization.default_locale_url_segment_redirect',
        'localization.session_redirect',
    ],
], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('{slug}', function ($slug) {
        if (false !== $controllerBag = Sluggable::dispatch(['slug' => $slug])) {
            return App::make($controllerBag->controller())->callAction(
                $controllerBag->method(),
                $controllerBag->arguments()
            );
        }
        abort(404);
    })->where('slug', '.+');

    Route::post('contact', 'Page\ContactController@store')->name('contact');
    Route::post('manage-local-info', 'HomeController@manageLocalInfo');
    Route::post('estimate-consumption', 'Page\CompareController@updateEstimatedConsumption');
    Route::post('update-previous-details', 'Page\CompareController@updatePreviousDetails');
    Route::post('post-selected-offer', 'Page\CompareController@postSelectedOffer');
    Route::post('insert-comment', 'Page\ProviderController@insertComment')->name('comment.insert');
    Route::post('insert-complaint', 'Page\ProviderController@insertComplaint')->name('complaint.insert');
    Route::post('update-counter-click', 'Page\CompareController@updateCounterClick');
    Route::post('update-personal-info', 'Page\PersonalDetailsController@updatePersonalInfo');
    Route::post('upload-documents', 'Page\PersonalDetailsController@uploadDocuments');
    Route::post('upload-signature', 'Page\PersonalDetailsController@uploadSignature');
    Route::post('update-steps-data', 'Page\InitialInfoController@updateStepsData');
    Route::post('update-user-personal-info', 'Page\InitialInfoController@updateUserPersonalInfo');
});
