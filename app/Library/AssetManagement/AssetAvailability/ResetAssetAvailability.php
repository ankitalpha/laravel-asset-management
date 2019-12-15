<?php

namespace Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability;

use Drivezy\LaravelAssetManager\Models\AssetBooking;
use Drivezy\LaravelUtility\Library\Message;

/**
 * Class ResetAssetAvailability
 * @package Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 */
class ResetAssetAvailability extends BaseAvailability
{
    /**
     * Pending and active Bookings array
     * Sorted with actual_start_time ascending
     * @var AssetBooking object|null
     */
    protected $bookings = [];

    /**
     * Reset Asset availability
     * True will reset all asset availability record and recreate it to the address given
     * False will just refresh position with timing.
     * @var bool
     */
    protected $reset = false;

    /**
     * Process setting add
     */
    public function process ()
    {
        if ( !$this->validation() )
            return false;

        $this->resetAvailability();

        return true;
    }

    /**
     * Validator checks to.
     * @return boolean
     */
    private function validation ()
    {
        if ( !$this->assetDetail )
            return Message::error('No such asset in system');

        if ( !$this->assetDetail->active )
            return Message::error('Asset is inactive.');

        return true;
    }

    /**
     * Reset Availability
     * Delete all availability
     * Fetch sorted array of blocking in ascending order
     */
    private function resetAvailability ()
    {
        $this->deleteAllAvailability($this->assetDetail->id);

        $this->getSortedArrayOfBooking();

        if ( !$this->reset )
            $this->refreshAvailability();
        else
            $this->setAvailability();
    }

    /**
     * Gives sorted arrays of blocks.
     * Get all bookings
     * Get all maintenance blocks
     * merge above both array and sort it.
     */
    private function getSortedArrayOfBooking ()
    {
        $this->getAllBookings();
        sort($this->bookings);
    }

    /**
     * Set availability of asset on a given address
     */
    private function setAvailability ()
    {
        $time = $this->currentTime;

        foreach ( $this->bookings as $booking ) {
            if ( $time >= $booking['actual_start_time'] ) {
                if ( $time <= $booking['actual_end_time'] )
                    $time = $booking['actual_end_time'];

                continue;
            }

            $this->createAvailability($time, $booking['actual_start_time'], $this->address->id);
            $time = $booking['actual_end_time'];
        }

        if ( $time < $this->maxAvailabilityDateTime )
            $this->createAvailability($time, $this->maxAvailabilityDateTime, $this->address->id);
    }


    /**
     * Refresh the availability on drop_address of bookings
     */
    private function refreshAvailability ()
    {
        $time = $this->currentTime;
        $addressId = $this->lastBookingAddressId();

        foreach ( $this->bookings as $booking ) {
            if ( $time >= $booking['actual_start_time'] ) {
                if ( $time <= $booking['actual_end_time'] ) {
                    $time = $booking['actual_end_time'];
                    $addressId = $booking['drop_address_id'];
                }

                continue;
            }

            $this->createAvailability($time, $booking['actual_start_time'], $addressId);
            $time = $booking['actual_end_time'];
            $addressId = $booking['drop_address_id'];
        }

        if ( $time < $this->maxAvailabilityDateTime )
            $this->createAvailability($time, $this->maxAvailabilityDateTime, $addressId);
    }

    /**
     * Eloquent to give all bookings having drop time in future to current time
     */
    private function getAllBookings ()
    {
        $this->bookings = AssetBooking::where('asset_detail_id', $this->assetDetail->id)
            ->where('status_id', '<', COMPLETED)
            ->where('actual_end_time', '>=', $this->lastAvailabilityTime)
            ->orderBy('actual_start_time', 'asc')
            ->get(['actual_start_time', 'actual_end_time', 'pickup_address_id', 'drop_address_id'])
            ->toArray();
    }

    /**
     * @return mixed
     */
    private function lastBookingAddressId ()
    {
        $booking = AssetBooking::where('asset_detail_id', $this->assetDetail->id)
            ->where('status_id', COMPLETED)
            ->where('actual_end_time', '<', $this->currentTime)
            ->orderBy('actual_end_time', 'desc')
            ->first();

        return $booking ? $booking->drop_address_id : $this->assetDetail->address_id;
    }
}