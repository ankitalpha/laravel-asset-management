<?php

namespace Drivezy\LaravelAssetManager\Controllers;

use Illuminate\Routing\Controller;

class AvailabilityController extends Controller
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
