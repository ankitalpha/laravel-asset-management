<?php

namespace Drivezy\LaravelAssetManager\Library\Booking;

use Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability\ResetAssetAvailability;
use Drivezy\LaravelAssetManager\Models\Address;
use Drivezy\LaravelAssetManager\Models\AssetDetail;
use Drivezy\LaravelAssetManager\Models\AssetLock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

/**
 * Class Utility
 * @package Drivezy\LaravelAssetManager\Library\Booking;
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class Utility
{
    /**
     * This method will drop the all the locks being acquired by the logged in user
     * @return bool
     */
    public static function dropUserLock ()
    {
        return AssetLock::where('user_id', Auth::id())->forceDelete();
    }

    /**
     * This will reset asset availability forcefully according to provided address_id
     *
     * @param $assetDetailId
     * @param $addressId
     * @return bool
     */
    public static function resetAssetAvailability ($assetDetailId, $addressId)
    {
        return ( new ResetAssetAvailability([
            'asset'   => AssetDetail::find($assetDetailId),
            'address' => Address::find($addressId),
        ]) )->process();
    }

    /**
     * This will reset asset availability on the basis of booking story line
     *
     * @param $assetDetailId
     * @return bool
     */
    public static function refreshAssetAvailability ($assetDetailId)
    {
        return ( new ResetAssetAvailability([
            'asset' => AssetDetail::find($assetDetailId),
        ]) )->process();
    }

    /**
     * Gives column names in a table
     * @param $table
     * @param $ignore
     * @return array
     * todo move it to laravel utility framework
     */
    public static function getColumns ($table, $ignore = [])
    {
        $columns = Schema::getColumnListing($table);

        return array_diff($columns, $ignore);
    }
}