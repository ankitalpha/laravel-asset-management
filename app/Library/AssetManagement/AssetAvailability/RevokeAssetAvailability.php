<?php

namespace Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability;

use Drivezy\LaravelAssetManager\Library\RecordManagement\AssetAvailabilityManagement;
use Drivezy\LaravelAssetManager\Models\Venue;

/**
 * Class RevokeAssetAvailability
 * @package Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 */
class RevokeAssetAvailability extends BaseAvailability
{

    /**
     * Pickup venue of Asset booking
     * @var Venue object|null
     */
    protected $pickupVenue = null;

    /**
     * Drop venue of Asset booking
     * @var Venue object|null
     */
    protected $dropVenue = null;

    /**
     * Process Request
     */
    public function process ()
    {
        $this->getAvailability();
        $this->makeAvailability();
    }

    /**
     * Fetch previous availability
     * Fetch next availability
     */
    private function getAvailability ()
    {
        $this->previousAvailability = AssetAvailability::where('end_time', $this->startTime)
            ->where('asset_detail_id', $this->assetDetail->id)
            ->where('venue_id', $this->pickupVenue->id)
            ->first();

        $this->nextAvailability = AssetAvailability::where('start_time', $this->endTime)
            ->where('asset_detail_id', $this->assetDetail->id)
            ->where('venue_id', $this->dropVenue->id)
            ->first();
    }

    /**
     * Make availability
     * if previous and next availability is there merge both
     * if only previousAvailability is there append its end time
     * if only nextAvailability is there append its start time
     * if both are not there create new availability
     * And update last availability block.
     */
    private function makeAvailability ()
    {
        if ( $this->previousAvailability && $this->nextAvailability ) {
            $this->mergeBothAvailability();
        }

        if ( $this->previousAvailability && !$this->nextAvailability ) {
            $this->appendPreviousAvailability();
        }

        if ( !$this->previousAvailability && $this->nextAvailability ) {
            $this->appendNextAvailability();
        }

        if ( !$this->previousAvailability && !$this->nextAvailability ) {
            $this->createAvailability($this->startTime, $this->endTime, $this->venue->id);
        }

        $this->createFutureAvailability();
    }

    /**
     * Merge both availability.
     * Delete next availability.
     */
    private function mergeBothAvailability ()
    {
        ( new AssetAvailabilityManagement([
            'end_time' => $this->nextAvailability->end_time,
        ], $this->previousAvailability) )->update();

        $this->nextAvailability->forceDelete();
    }

    /**
     * Append end time to previous availability.
     */
    private function appendPreviousAvailability ()
    {
        ( new AssetAvailabilityManagement([
            'end_time' => $this->end_time,
        ], $this->previousAvailability) )->update();
    }

    /**
     * Append start time next availability.
     */
    private function appendNextAvailability ()
    {
        ( new AssetAvailabilityManagement([
            'start_time' => $this->start_time,
            'venue_id'   => $this->dropVenue->id,
        ], $this->nextAvailability) )->update();
    }
}