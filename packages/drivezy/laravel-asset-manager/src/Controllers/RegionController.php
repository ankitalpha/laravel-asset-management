<?php

namespace Drivezy\LaravelAssetManager\Controllers;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use Drivezy\LaravelAssetManager\Models\Region;

/**
 * Class RegionController
 * @package Drivezy\LaravelAssetManager\Controllers
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class RegionController extends RecordController
{
    /**
     * @var Region model path.
     */
    protected $model = Region::class;
}