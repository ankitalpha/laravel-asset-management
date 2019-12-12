<?php

namespace Drivezy\LaravelAssetManager\Library\AssetManagement;

use Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability\ResetAssetAvailability;
use Drivezy\LaravelAssetManager\Models\Address;
use Drivezy\LaravelAssetManager\Models\AssetDetail;

/**
 * Class AssetUtility
 * @package App\Library\AssetManagement
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 */
class AssetUtility
{
    public static function resetAssetAvailability ($assetDetailId, $addressId)
    {
        return ( new ResetAssetAvailability([
            'asset'   => AssetDetail::find($assetDetailId),
            'address' => Address::find($addressId),
        ]) )->process();
    }

    public static function refreshAssetAvailability ($assetDetailId, $addressId)
    {
        return ( new ResetAssetAvailability([
            'asset'   => AssetDetail::find($assetDetailId),
        ]) )->process();
    }
}