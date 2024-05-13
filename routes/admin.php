<?php
use Illuminate\Support\Facades\Route;

// Inbox
Route::group([
    'namespace' => 'Admin\Inbox',
    'prefix' => '/admin/inbox',
    'as' => 'admin.inbox.',
    'middleware' => 'auth'], function () {

        Route::get(
            '/',
            'IndexController@index'
        )->name('index');

        Route::get(
            '/admin/inbox/message/{id}',
            'IndexController@show'
        )->name('show');
    });

// kCMS
Route::group([
    'namespace' => 'Admin',
    'prefix'=>'/admin',
    'as' => 'admin.',
    'middleware' => 'auth'], function () {

    Route::get('/', function () {
        return redirect('admin/dashboard/seo');
    });

    // Slider
    Route::post('slider/set', 'Slider\IndexController@sort')->name('slider.sort');
    Route::post('gallery/set', 'Gallery\IndexController@sort')->name('gallery.sort');
    Route::post('image/set', 'Gallery\ImageController@sort')->name('image.sort');
    Route::post('box/set', 'Box\IndexController@sort')->name('box.sort');
    Route::post('offer/set', 'Offer\IndexController@sort')->name('offer.sort');
    Route::post('client/set', 'Client\IndexController@sort')->name('client.sort');
    Route::post('testimonial/set', 'Testimonial\IndexController@sort')->name('testimonial.sort');

    // Gallery
    Route::get('ajaxGetGalleries', 'Gallery\IndexController@ajaxGetGalleries')->name('ajaxGetGalleries');

    Route::resources([
        'dictionary' => 'Dictionary\IndexController',
        'page' => 'Page\IndexController',
        'url' => 'Url\IndexController',
        'slider' => 'Slider\IndexController',
        'box' => 'Box\IndexController',
        'testimonial' => 'Testimonial\IndexController',
        'client' => 'Client\IndexController',
        'offer' => 'Offer\IndexController',
        'user' => 'User\IndexController',
        'role' => 'Role\IndexController',
        'logs' => 'Log\IndexController',
        'greylist' => 'Greylist\IndexController',
        'gallery' => 'Gallery\IndexController',
        'image' => 'Gallery\ImageController'
    ]);

    Route::get('dictionary/{slug}/{locale}/edit', 'Dictionary\IndexController@edit')->name('dictionary.edit');

    // Dashboard
    Route::group(['prefix'=>'/dashboard', 'as' => 'dashboard.'], function () {

        Route::resources([
        'seo' => 'Dashboard\SeoController',
        'social' => 'Dashboard\SocialController'
        ]);
    });
});
Route::get('{uri}', 'Front\MenuController@index')->where('uri', '([A-Za-z0-9\-\/]+)');
