<?php

namespace Drivezy\LaravelAssetManager\Controllers;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use Drivezy\LaravelAssetManager\Models\AssetAvailability;

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
     * @var AssetAvailability model path.
     */
    protected $model = AssetAvailability::class;
}