<?php

    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::group([
        'prefix' => config('app.admin_panel_uri'),
        'as'     => 'backend.',
    ], function () {
        Route::resource('campaigns', 'CampaignsController')->except(['show']);
        Route::resource('banners', 'BannersController')->except(['show']);
        Route::post('banners/upload', 'BannersController@upload')->name('banners.upload');
        Route::get('banners/images', 'BannersController@images')->name('banners.images');
        Route::get('banners/images/delete', 'BannersController@imagesDelete')->name('banners.images.delete');
    });
    Route::get('images/click', 'BannersController@click')->name('images.click');
