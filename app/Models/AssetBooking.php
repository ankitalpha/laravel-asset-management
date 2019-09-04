<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\AssetBookingObserver;

/**
 * Class AssetBooking
 * @package Drivezy\LaravelAssetManager\Models
 *
 * @see https://github.com/drivezy/laravel-asset-manager.
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetBooking extends BaseModel
{

    /**
     * @var string
     * The AssetBooking table name.
     */
    protected $table = 'dz_asset_booking';

    /**
     * Boot observer.
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new AssetBookingObserver());
    }
}