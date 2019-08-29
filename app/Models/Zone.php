<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\ZoneObserver;

/**
 * Class Zone
 * @package Drivezy\LaravelAssetManager
 *
 * @see https://github.com/drivezy/laravel-asset-manager.
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class Zone extends BaseModel
{

    /**
     * @var string
     * The Zone table name.
     */
    protected $table = 'dz_zones';

    /**
     * Boot observer.
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ZoneObserver());
    }
}