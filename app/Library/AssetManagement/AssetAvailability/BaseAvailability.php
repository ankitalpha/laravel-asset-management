<?php

namespace Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability;

use Drivezy\LaravelAssetManager\Models\AssetAvailability;
use Drivezy\LaravelUtility\LaravelUtility;
use Drivezy\LaravelUtility\Library\DateUtil;
use Illuminate\Support\Str;

/**
 * Class BaseAvailability
 * @package Drivezy\LaravelAssetManager\Library\AssetManagement\AssetAvailability
 *
 * @see  task on JIRA
 */
class BaseAvailability
{

    /**
     * The requested parameters
     * @var array
     */
    private $request = [];

    /**
     * Current time
     * @var null
     */
    protected $currentTime = null;

    /**
     * The AssetDetail object
     * @var null
     */
    protected $assetDetail = null;

    /**
     * The Venue object
     * @var null
     */
    protected $venue = null;

    /**
     * The AssetAvailability record.
     * @var null
     */
    public $availability = null;

    /**
     * Property that will give maximum future days till what availability have to be created.
     * @var int
     */
    private $maxAvailabilityDays = 300;

    /**
     * To store date time till what future availability is to be created.
     * @var null
     */
    protected $maxAvailabilityDateTime = null;

    /**
     * Block start time
     * @var null
     */
    protected $startTime = null;

    /**
     * Block end time
     * @var null
     */
    protected $endTime = null;

    /**
     * Previous availability to the AssetAvailability record
     * @var null
     */
    protected $previousAvailability = null;

    /**
     * Next availability to the AssetAvailability record
     * @var null
     */
    protected $nextAvailability = null;


    /**
     * AssetAvailabilityManagement constructor.
     * @param $request
     */
    public function __construct ($request)
    {
        $this->request = $request;
        $this->setBasicVariables();
    }

    /**
     * Set Basic variables for all class which are extending this current class
     */
    private function setBasicVariables ()
    {
        foreach ( $this->request as $key => $value ) {
            $key = Str::camel();
            $this->$key = $value;
        }

        $this->currentTime = DateUtil::getDateTime();

        $this->maxAvailabilityDays = LaravelUtility::getProperty('future.availability.days', $this->maxAvailabilityDays);
        $this->maxAvailabilityDateTime = DateUtil::getFutureTime($this->maxAvailabilityDays * 24 * 60, $this->currentTime);
    }

    /**
     * Create Availability time
     * @param $startTime
     * @param $endTime
     * @param $venueId
     */
    protected function createAvailability ($startTime, $endTime, $venueId)
    {
        if ( DateUtil::getDateTimeDifference($startTime, $endTime) <= 0 ) return;

        $asset = AssetAvailability::firstOrNew(
            [
                'start_timestamp'   => strtotime($startTime),
                'end_timestamp'     => strtotime($endTime),
                'start_time'        => $startTime,
                'end_time'          => $endTime,
                'duration'          => DateUtil::getDateTimeDifference($startTime, $endTime),
                'venue_id'          => $venueId,
                'asset_detail_id'   => $this->assetDetail->id,
                'asset_category_id' => $this->assetDetail->category_id,
            ]
        );

        $asset->save();
    }

    /**
     * Delete All availability of the vehicle.
     * @param $assetDetailId
     */
    public static function deleteAllAvailability ($assetDetailId)
    {
        AssetAvailability::where('vehicle_id', $assetDetailId)->forceDelete();
    }

    /**
     * Will extend future availability with max future availability property
     */
    protected function createFutureAvailability ()
    {
        $asset = AssetAvailability::where('vehicle_id', $this->assetDetail->id)
            ->orderBy('end_time', 'DESC')
            ->first();

        if ( !$asset ) return;

        $asset->end_time = $this->maxAvailabilityDateTime;
        $asset->save();
    }
}