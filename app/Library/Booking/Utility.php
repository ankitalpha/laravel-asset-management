<?php

namespace Drivezy\LaravelAssetManager\Library\Booking;

use Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability\ResetAssetAvailability;
use Drivezy\LaravelAssetManager\Models\Address;
use Drivezy\LaravelAssetManager\Models\AssetBooking;
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
     * @param userId null|int
     * @return bool
     */
    public static function dropUserLock ($userId = null)
    {
        $userId = $userId ?? Auth::id();

        return AssetLock::where('user_id', $userId)->forceDelete();
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

    /**
     * @return int
     * @todo make a better logic than this
     */
    public static function generateReferenceNumber ()
    {
        while ( true ) {
            $token = rand(1000000000, 9999999999);

            if ( 0 == AssetBooking::where('reference_number', '=', $token)->count() )
                return $token;
        }
    }
}