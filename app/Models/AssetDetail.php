<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\AssetDetailObserver;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class AssetDetail
 * @package Drivezy\LaravelAssetManager\Models
 *
 * @see https://github.com/drivezy/laravel-asset-manager.
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetDetail extends BaseModel
{
    /**
     * @var string
     * The AssetDetail table name.
     */
    protected $table = 'dz_asset_details';

    /**
     * @return HasOne
     */
    public function asset_category ()
    {
        return $this->hasOne(AssetCategory::class);
    }

    /**
     * @return HasOne
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
        self::observe(new AssetDetailObserver());
    }
}