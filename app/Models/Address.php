<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelAssetManager\Observers\AddressObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Address
 * @package Drivezy\LaravelAssetManager\Models
 *
 * @see https://github.com/drivezy/laravel-asset-manager.
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class Address extends BaseModel
{

    /**
     * @var string
     * The Address table name.
     */
    protected $table = 'dz_address_details';

    /**
     * @return BelongsTo
     */
    public function asset_booking ()
    {
        return $this->belongsTo(AssetBooking::class, 'source_id', 'id')
            ->where('source_type', md5(AssetBooking::class));
    }

    /**
     * @return BelongsTo
     */
    public function venue ()
    {
        return $this->belongsTo(Venue::class, 'source_id', 'id')
            ->where('source_type', md5(Venue::class));
    }

    /**
     * @return BelongsTo
     */
    public function zone ()
    {
        return $this->belongsTo(Zone::class, 'source_id', 'id')
            ->where('source_type', md5(Zone::class));
    }

    /**
     * @return BelongsTo
     */
    public function region ()
    {
        return $this->belongsTo(Region::class, 'source_id', 'id')
            ->where('source_type', md5(Region::class));
    }

    /**
     * @return BelongsTo
     */
    public function country ()
    {
        return $this->belongsTo(Country::class, 'source_id', 'id')
            ->where('source_type', md5(Country::class));
    }

    /**
     * Boot observer.
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new AddressObserver());
    }
}