<?php

namespace Drivezy\LaravelAssetManager\Models;

use Drivezy\LaravelAssetManager\Observers\AddressObserver;
use Drivezy\LaravelUtility\LaravelUtility;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
     * @return HasOne
     * @return The User object
     */
    public function user ()
    {
        return $this->hasOne(LaravelUtility::getUserModelFullQualifiedName(), 'id', 'source_id')
            ->where('source_type', md5(LaravelUtility::getUserModelFullQualifiedName()));
    }

    /**
     * @return HasOne
     */
    public function zone ()
    {
        return $this->hasOne(Zone::class, 'id', 'source_id')->where('source_type', md5(Zone::class));
    }

    /**
     * @return HasOne
     */
    public function region ()
    {
        return $this->hasOne(Region::class, 'id', 'source_id')->where('source_type', md5(Region::class));
    }

    /**
     * @return HasOne
     */
    public function country ()
    {
        return $this->hasOne(Country::class, 'id', 'source_id')->where('source_type', md5(Country::class));
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