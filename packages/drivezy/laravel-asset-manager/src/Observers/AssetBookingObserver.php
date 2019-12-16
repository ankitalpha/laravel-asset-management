<?php

namespace Drivezy\LaravelAssetManager\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class AssetBooking
 * @package Drivezy\LaravelAssetManager\Observer
 *
 * @see https://github.com/drivezy/laravel-asset-manager.
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetBookingObserver extends BaseObserver
{
    /**
     * @var array Required parameters.
     */
    protected $rules = [
        'user_id'           => 'required',
        'asset_detail_id'   => 'required',
        'pickup_address_id' => 'required',
        'drop_address_id'   => 'required',
    ];
}