<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\AssetLockObserver;

/**
 * Class AssetLock
 * @package Drivezy\LaravelAssetManager
 *
 * @see https://github.com/drivezy/laravel-asset-manager.
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetLock extends BaseModel
{

    /**
     * @var string
     * The AssetLock table name.
     */
    protected $table = 'dz_asset_locks';

    /**
     * Boot observer.
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new AssetLockObserver());
    }
}