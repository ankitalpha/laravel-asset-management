<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\AssetAvailabilityObserver;

/**
 * Class AssetAvailability
 * @package Drivezy\LaravelAssetManager
 *
 * @see https://github.com/drivezy/laravel-asset-manager.
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetAvailability extends BaseModel
{

    /**
     * @var string
     * The AssetAvailability table name.
     */
    protected $table = 'dz_asset_availabilities';

    /**
     * Boot observer.
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new AssetAvailabilityObserver());
    }
}