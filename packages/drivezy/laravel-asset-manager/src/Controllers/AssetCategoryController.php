<?php

namespace Drivezy\LaravelAssetManager\Controllers;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use Drivezy\LaravelAssetManager\Models\AssetCategory;

/**
 * Class AssetCategoryController
 * @package Drivezy\LaravelAssetManager\Controllers
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetCategoryController extends RecordController
{
    /**
     * @var AssetCategory model path.
     */
    protected $model = AssetCategory::class;
}