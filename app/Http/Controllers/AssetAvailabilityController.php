<?php

namespace Drivezy\LaravelAssetManager\Controllers;

use App\Library\Booking\Management;
use Drivezy\LaravelAssetManager\Library\Booking\Creation;
use Drivezy\LaravelRecordManager\Controllers\RecordController;
use Illuminate\Http\Request;

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
     * Fetch asset availability for the asset
     *
     * @param Request $request
     * @return mixed
     */
    public function assetAvailability (Request $request)
    {
        $booking = ( new Management($request->all()) )->request;

        return fixed_response($booking->execute());
    }


    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function createBooking (Request $request)
    {
        $booking = ( new Creation($request->all()) );

        return fixed_response($booking->createBooking());
    }
}
