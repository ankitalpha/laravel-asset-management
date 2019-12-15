<?php

namespace Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability;

use Drivezy\LaravelAssetManager\Library\RecordManagement\AssetAvailabilityManagement;
use Drivezy\LaravelAssetManager\Models\Address;
use Drivezy\LaravelUtility\Library\DateUtil;

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
     * Pickup address of Asset booking
     * @var Address object|null
     */
    protected $pickupAddress = null;

    /**
     * Drop address of Asset booking
     * @var Address object|null
     */
    protected $dropAddress = null;

    /**
     * Case in which user have take asset before its booking start time
     * We will set availability from the time asset was handed over.
     * @return bool
     */
    public function earlyHandoverOfAsset ()
    {
        $this->getPreviousAvailability();

        if ( !$this->previousAvailability ) return true;

        ( new AssetAvailabilityManagement([
            'start_time' => DateUtil::getDateTime(),
        ], $this->previousAvailability) )->update();
    }

    /**
     * Case in which user have given back asset before its booking end time
     * We will set availability from the time asset was returned.
     */
    public function earlyReturningOfAsset ()
    {
        $this->getNextAvailability();

        if ( !$this->nextAvailability ) {
            return $this->createAvailability(DateUtil::getDateTime(), $this->endTime, $this->dropAddress->id);
        }

        return ( new AssetAvailabilityManagement([
            'start_time' => DateUtil::getDateTime(),
        ], $this->nextAvailability) )->update();
    }

    /**
     * Revoke availability
     */
    public function revoke ()
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
        $this->getPreviousAvailability();
        $this->getNextAvailability();
    }

    /**
     * Fetch previous availability
     */
    private function getPreviousAvailability ()
    {
        $this->previousAvailability = AssetAvailability::where('end_time', $this->startTime)
            ->where('asset_detail_id', $this->assetDetail->id)
            ->where('address_id', $this->pickupAddress->id)
            ->first();
    }

    /**
     * Fetch next availability of asset.
     */
    private function getNextAvailability ()
    {
        $this->nextAvailability = AssetAvailability::where('start_time', $this->endTime)
            ->where('asset_detail_id', $this->assetDetail->id)
            ->where('address_id', $this->dropAddress->id)
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
            $this->createAvailability($this->startTime, $this->endTime, $this->address->id);
        }
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
            'end_time' => $this->endTime,
        ], $this->previousAvailability) )->update();
    }

    /**
     * Append start time next availability.
     */
    private function appendNextAvailability ()
    {
        ( new AssetAvailabilityManagement([
            'start_time' => $this->startTime,
            'address_id' => $this->dropAddress->id,
        ], $this->nextAvailability) )->update();
    }
}