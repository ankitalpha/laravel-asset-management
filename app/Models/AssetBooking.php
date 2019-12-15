<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelUtility\LaravelUtility;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\AssetBookingObserver;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
     * @return HasOne
     */
    public function user ()
    {
        return $this->hasOne(LaravelUtility::getUserModelFullQualifiedName());
    }

    /**
     * @return HasOne
     */
    public function asset_detail ()
    {
        return $this->hasOne(AssetDetail::class);
    }

    /**
     * @return HasOne
     */
    public function pickup_address ()
    {
        return $this->hasOne(Address::class);
    }

    /**
     * @return HasOne
     */
    public function drop_address ()
    {
        return $this->hasOne(Address::class);
    }

    /**
     * @return HasOne
     */
    public function type ()
    {
        return $this->hasOne(LookupValue::class);
    }

    /**
     * @return HasOne
     */
    public function status ()
    {
        return $this->hasOne(LookupValue::class);
    }

    /**
     * Boot observer.
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new AssetBookingObserver());
    }
}