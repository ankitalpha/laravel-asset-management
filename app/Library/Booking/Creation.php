<?php

namespace Drivezy\LaravelAssetManager\Library\Booking;

use Drivezy\LaravelAssetManager\Library\RequestManagment;
use Drivezy\LaravelAssetManager\Models\AssetBooking;

/**
 * Class Creation
 * @package Drivezy\LaravelAssetManager\Library\Booking
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 */
class Creation extends RequestManagment
{
    /**
     * @var null
     */
    private $classInstance = null;

    /**
     * Creation constructor.
     * @param $request
     */
    public function __construct ($request)
    {
        $this->request = $request->request;
        $this->classInstance = $request;
    }

    /**
     * Creates booking
     * @return array
     * @throws \Exception
     */
    public function createBooking ()
    {
        $result = $this->classInstance->execute();

        if ( !$result['success'] )
            return $result;

        $this->bookCar();

        $this->getResponse();

        return success_message($this->request);
    }

    /**
     * This method will the book car based on booking type
     */
    public function bookCar ()
    {
        Utility::dropUserLock();
        $this->createBookingObject();
        Utility::createAssetLock($this->request->booking, $this->request->lockTime ?? false);
    }


    /**
     * Prepares initial booking parameters that are available.
     * And create The Booking record
     */
    private function createBookingObject ()
    {
        $this->request->booking = new AssetBooking();

        $columns = Utility::getColumns('dz_asset_bookings', ['id']);

        foreach ( $columns as $column ) {
            $this->request->booking->$column = $this->request->$column ?? null;
        }

        $this->request->booking->reference_number = Utility::generateReferenceNumber();
        $this->request->booking->save();
    }

    /**
     * Fetch response
     */
    private function getResponse ()
    {
        foreach ( $this->classInstance->responseManager as $responseManager ) {
            $this->request = ( new $responseManager($this->request) )->response();
        }
    }
}