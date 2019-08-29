<?php

namespace Drivezy\LaravelAssetManager\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class Address
 * @package Drivezy\LaravelAssetManager
 *
 * @see https://github.com/drivezy/laravel-asset-manager.
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AddressObserver extends BaseObserver
{

    /**
     * @var array Required parameters.
     */
    protected $rules = [
        'house_address' => 'required',
        'source_type'   => 'required',
        'source_id'     => 'required',
    ];
}