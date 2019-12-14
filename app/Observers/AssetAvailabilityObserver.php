<?php

namespace Drivezy\LaravelAssetManager\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class AssetAvailability
 * @package Drivezy\LaravelAssetManager\Observer
 *
 * @see https://github.com/drivezy/laravel-asset-manager.
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetAvailabilityObserver extends BaseObserver
{
    /**
     * @var array Required parameters.
     */
    protected $rules = [];
}