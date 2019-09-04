<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\RegionObserver;

/**
 * Class Region
 * @package Drivezy\LaravelAssetManager\Models
 *
 * @see https://github.com/drivezy/laravel-asset-manager.
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class Region extends BaseModel
{

    /**
     * @var string
     * The Region table name.
     */
    protected $table = 'dz_regions';

    /**
     * Boot observer.
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new RegionObserver());
    }
}