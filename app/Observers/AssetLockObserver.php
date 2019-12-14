<?php

namespace Drivezy\LaravelAssetManager\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class AssetLock
 * @package Drivezy\LaravelAssetManager\Observer
 *
 * @see https://github.com/drivezy/laravel-asset-manager.
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetLockObserver extends BaseObserver
{
    /**
     * @var array Required parameters.
     */
    protected $rules = [
        'user_id'     => 'required',
        'expiry_time' => 'required',
    ];
}