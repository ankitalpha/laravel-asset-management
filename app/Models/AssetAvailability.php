<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\AssetAvailabilityObserver;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class AssetAvailability
 * @package Drivezy\LaravelAssetManager\Models
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
     * @return HasOne
     * @return AssetCategory object
     */
    public function asset_category ()
    {
        return $this->hasOne(AssetCategory::class);
    }

    /**
     * @return HasOne
     * @return AssetDetail object
     */
    public function asset_detail ()
    {
        return $this->hasOne(AssetDetail::class);
    }

    /**
     * @return HasOne
     * @return Venue object
     */
    public function address ()
    {
        return $this->hasOne(Address::class);
    }

    /**
     * Boot observer.
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new AssetAvailabilityObserver());
    }
}