<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelUtility\LaravelUtility;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\AssetLockObserver;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class AssetLock
 * @package Drivezy\LaravelAssetManager\Models
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
     * @return HasOne
     * @return The User object
     */
    public function user ()
    {
        return $this->hasOne(LaravelUtility::getUserModelFullQualifiedName());
    }

    /**
     * @return HasOne
     * @return The asset_detail record
     */
    public function asset_detail ()
    {
        return $this->hasOne(AssetDetail::class);
    }

    /**
     * Boot observer.
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new AssetLockObserver());
    }
}