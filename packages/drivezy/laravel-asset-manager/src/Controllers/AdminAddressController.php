<?php

namespace Drivezy\LaravelAssetManager\Controllers;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use Drivezy\LaravelAssetManager\Models\Address;

/**
 * Class AdminAddressController
 * @package Drivezy\LaravelAssetManager\Controllers
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AdminAddressController extends RecordController
{
    /**
     * @var Address model path.
     */
    protected $model = Address::class;
}