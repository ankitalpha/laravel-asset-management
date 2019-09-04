<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\AssetDetailObserver;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return BelongsTo
     * @return AssetCategory object
     */
    public function asset_category ()
    {
        return $this->belongsTo(AssetCategory::class);
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