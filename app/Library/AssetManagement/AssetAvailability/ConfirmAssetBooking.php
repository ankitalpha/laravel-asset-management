<?php

namespace Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability;

use Drivezy\LaravelAssetManager\Library\RecordManagement\AssetAvailabilityManagement;
use Drivezy\LaravelAssetManager\Models\AssetAvailability;

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
     * ConfirmAssetBooking constructor.
     * @param $request
     */
    public function __construct ($request)
    {
        parent::__construct($request);
    }

    /**
     * Process request
     */
    public function process ()
    {
        $this->setVariables();
        $this->blockVehicle();
    }

    /**
     * Set variables for request
     */
    private function setVariables ()
    {
        $this->getPreviousAvailability();
        $this->getNextAvailability();
    }

    /**
     * Create new availability according to block.
     */
    private function blockVehicle ()
    {
        $this->setPreviousAvailability();
        $this->setNextAvailability();

        $this->availability->forceDelete();

        $this->createFutureAvailability();
    }

    /**
     * This will set previous availability record if any.
     * else will create new availability record.
     */
    private function setPreviousAvailability ()
    {
        if ( $this->availability->start_time == $this->startTime ) return;

        if ( $this->previousAvailability ) {
            ( new AssetAvailabilityManagement([
                'end_time' => $this->startTime,
            ], $this->previousAvailability
            ) )->update();
        } else {
            $this->createAvailability($this->availability->start_time, $this->startTime, $this->availability->venue_id);
        }
    }

    /**
     * This will set next availability record if any.
     * else will create new availability record.
     */
    private function setNextAvailability ()
    {
        if ( $this->availability->end_time == $this->endTime ) return;

        if ( $this->nextAvailability ) {
            ( new AssetAvailabilityManagement([
                'start_time' => $this->endTime,
                'venue_id'   => $this->venue->id,
            ], $this->nextAvailability
            ) )->update();
        } else {
            $this->createAvailability($this->endTime, $this->maxAvailabilityDateTime, $this->venue->id);
        }
    }

    /**
     * Fetch previous availability to AssetAvailability
     */
    private function getPreviousAvailability ()
    {
        $this->previousAvailability = AssetAvailability::where('asset_detail_id', $this->assetDetail->id)
            ->where('end_time', '<=', $this->availability->start_time)
            ->where('id', '!=', $this->availability->id)
            ->orderBy('end_time', 'desc')
            ->first();
    }

    /**
     * Fetch next availability to AssetAvailability
     */
    public function getNextAvailability ()
    {
        $this->nextAvailability = AssetAvailability::where('asset_detail_id', $this->assetDetail->id)
            ->where('start_time', '>=', $this->availability->start_time)
            ->where('id', '!=', $this->availability->id)
            ->orderBy('start_time', 'asc')
            ->first();
    }
}