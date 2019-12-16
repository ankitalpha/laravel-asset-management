<?php

namespace Drivezy\LaravelAssetManager\Library\AssetManagement\AssetSearch;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelAssetManagerServiceProvider
 * @package App\Providers
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class LaravelAssetManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register ()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadMigrationFrom(__DIR__ . '/Database/Migrations');

        $this->publishes([
            __DIR__ . '/Library/Booking/Process' => app_path('Library/AssetBooking/Process/'),
        ], 'booking-directory');

        $this->publishes([
            __DIR__ . '/Library/Booking/Response' => app_path('Library/AssetBooking/Response/'),
        ], 'booking-directory');

        $this->publishes([
            __DIR__ . '/Library/Booking/Sanitiser' => app_path('Library/AssetBooking/Sanitiser/'),
        ], 'booking-directory');

        $this->publishes([
            __DIR__ . '/Library/Booking/Type' => app_path('Library/AssetBooking/Type/'),
        ], 'booking-directory');

        $this->publishes([
            __DIR__ . '/Library/Booking/Validator' => app_path('Library/AssetBooking/Validator/'),
        ], 'booking-directory');

        $this->publishes([
            __DIR__ . '/Library/Booking/Creation.php' => app_path('Library/AssetBooking/'),
        ], 'booking-directory');

        $this->publishes([
            __DIR__ . '/Library/Booking/Management.php' => app_path('Library/AssetBooking/'),
        ], 'booking-directory');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot ()
    {
        //
    }
}
