<?php

namespace Drivezy\LaravelAssetManager\Controllers;

use Drivezy\LaravelAssetManager\Models\AssetAvailability;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class AssetAvailabilityController
 * @package Drivezy\LaravelAssetManager\Controllers
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetAvailabilityController extends RecordController
{
    /**
     * @var string
     */
    protected $model = AssetAvailability::class;
}
