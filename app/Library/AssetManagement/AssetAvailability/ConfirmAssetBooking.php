<?php

namespace Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability;


use JRApp\Libraries\Utility\AssetManagement\AssetAvailabilityRecordManagement;

/**
 * Class ConfirmAssetBooking
 * @package Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 */
class ConfirmAssetBooking extends BaseAvailability
{
    /**
     * @var null
     */
    protected $pickupAddress = null;

    /**
     * @var null
     */
    protected $dropAddress = null;

    /**
     * ConfirmAssetBlocking constructor.
     * @param $request
     */
    public function __construct ($request)
    {
        parent::__construct($request);
    }

    /**
     * ConfirmBooking for on an available slot
     * Constraint that is fixed is that always one available slot will be provided to confirm block
     * So, based on above constraint there are 4 possibilities of shrinking available slots
     * Suppose _ (Dash) as available slot and @ (at) as block slot
     *
     * i) When blocking of asset is not same as available slot but in between of available slot
     *    so shrink the middle part and make one left slot available record and one right slot available record
     *    so slot will look like this _@_ (Dash at Dash)
     *
     *
     * ii) When blocking of asset is same as right slot of available record but not the left part
     *     so shrink the right part and make one left slot available record only
     *     so slot will look like this _@(Dash at)
     *
     * iii) When blocking of asset is same as left slot of available record but not the right part
     *      so shrink the right part and make one left slot available record only
     *      so slot will look like this @_(at Dash)
     *
     * iv) When blocking of asset is same as the whole slot of available record.
     *     So shrink whole asset availability
     *      so slot will look like this @@(at at)
     */
    public function confirmBooking ()
    {
        if ( $this->assetAvailability->start_time < $this->startTime
            && $this->assetAvailability->end_time > $this->endTime ) {
            return $this->shrinkMiddlePartOfAvailability();
        }

        if ( $this->assetAvailability->start_time < $this->startTime
            && $this->assetAvailability->end_time == $this->endTime ) {
            return $this->shrinkRightPartOfAvailability();
        }

        if ( $this->assetAvailability->start_time == $this->startTime
            && $this->assetAvailability->end_time > $this->endTime ) {
            return $this->shrinkLeftPartOfAvailability();
        }

        if ( $this->assetAvailability->start_time == $this->startTime
            && $this->assetAvailability->end_time == $this->endTime ) {
            return $this->shrinkWholeAvailability();
        }
    }

    /**
     *
     */
    public function extension ()
    {
        if ( $this->assetAvailability->end_time == $this->endTime )
            $this->assetAvailability->forceDelete();

        ( new AssetAvailabilityRecordManagement([
            'start_time' => $this->endTime,
        ], $this->assetAvailability
        ) )->update();
    }

    /**
     *
     */
    public function prepone ()
    {
        if ( $this->assetAvailability->start_time == $this->startTime )
            $this->assetAvailability->forceDelete();

        ( new AssetAvailabilityRecordManagement([
            'end_time' => $this->startTime,
        ], $this->assetAvailability
        ) )->update();
    }

    /**
     * When we have to make left and right part available
     * And have to block the middle part of the availability
     * _@_
     */
    private function shrinkMiddlePartOfAvailability ()
    {
        $this->createAvailability($this->assetAvailability->start_time, $this->startTime, $this->pickupAddress->id);

        $this->createAvailability($this->endTime, $this->assetAvailability->end_time, $this->dropAddress->id);

        $this->shrinkWholeAvailability();
    }

    /**
     * When we have to make left part available
     * And have to block right part
     * _@
     */
    private function shrinkLeftPartOfAvailability ()
    {
        $this->createAvailability($this->endTime, $this->assetAvailability->end_time, $this->pickupAddress->id);

        $this->shrinkWholeAvailability();
    }

    /**
     * When we have to make right part available
     * And have to block left part
     * @_
     */
    private function shrinkRightPartOfAvailability ()
    {
        $this->createAvailability($this->assetAvailability->start_time, $this->startTime, $this->dropAddress->id);

        $this->shrinkWholeAvailability();
    }

    /**
     * when whole availability have to be blocked
     * @@
     */
    private function shrinkWholeAvailability ()
    {
        $this->assetAvailability->forceDelete();
    }
}