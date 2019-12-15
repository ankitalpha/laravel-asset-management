<?php

namespace Drivezy\LaravelAssetManager\Controllers;

use Drivezy\LaravelAssetManager\Library\Booking\Creation;
use Drivezy\LaravelAssetManager\Library\Booking\Management;
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
        $request->request->set('create_booking', true);
        $booking = ( new Management($request->all()) )->request;

        return fixed_response(( new Creation($booking) )->book());
    }
}
