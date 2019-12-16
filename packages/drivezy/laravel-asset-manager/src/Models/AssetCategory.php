<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelRecordManager\Models\DataModel;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\AssetCategoryObserver;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class AssetCategory
 * @package Drivezy\LaravelAssetManager\Models
 *
 * @see https://github.com/drivezy/laravel-asset-manager.
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetCategory extends BaseModel
{
    /**
     * @var string
     * The AssetCategory table name.
     */
    protected $table = 'dz_asset_categories';

    /**
     * @return HasOne
     */
    public function model ()
    {
        return $this->hasOne(DataModel::class, 'model_hash', 'model_hash');
    }

    /**
     * Boot observer.
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new AssetCategoryObserver());
    }
}