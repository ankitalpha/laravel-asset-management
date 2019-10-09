<?php

namespace Drivezy\LaravelAssetManager\Library\Booking;

use Drivezy\LaravelAssetManager\Models\AssetLock;
use Illuminate\Support\Facades\Auth;

/**
 * Class BookingUtility
 * @package Drivezy\LaravelAssetManager\Library\Booking;
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class BookingUtility
{
    /**
     * This method will drop the all the locks being acquired by the logged in user
     * @return bool
     */
    public static function dropUserLock ()
    {
        return AssetLock::where('user_id', Auth::id())->forceDelete();
    }
}