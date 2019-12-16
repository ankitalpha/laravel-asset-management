<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelAssetManager\Observers\ZoneObserver;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Zone
 * @package Drivezy\LaravelAssetManager\Models
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
     * @return HasOne
     */
    public function region ()
    {
        return $this->hasOne(Region::class);
    }

    /**
     * Boot observer.
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ZoneObserver());
    }
}