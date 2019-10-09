<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\AssetAvailabilityObserver;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return BelongsTo
     * @return AssetDetail object
     */
    public function asset_detail ()
    {
        return $this->belongsTo(AssetDetail::class);
    }

    /**
     * @return BelongsTo
     * @return AssetCategory object
     */
    public function asset_category ()
    {
        return $this->belongsTo(AssetCategory::class);
    }

    /**
     * @return BelongsTo
     * @return Venue object
     */
    public function venue ()
    {
        return $this->belongsTo(Venue::class);
    }

    /**
     * Boot observer.
     */
    public static function boot ()
    {
        parent::boot();
//        self::observe(new AssetAvailabilityObserver());
    }
}