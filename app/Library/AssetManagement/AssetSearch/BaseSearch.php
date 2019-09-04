<?php

namespace Drivezy\LaravelAssetManager\Library\AssetManagement\AssetSearch;

use Drivezy\LaravelAssetManager\Models\AssetAvailability;
use Illuminate\Support\Str;

/**
 * Class BaseSearch
 * @package Drivezy\LaravelAssetManager\Library\AssetManagement\AssetSearch
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 * TODO check with variables name
 */
class BaseSearch
{

    /**
     * BaseSearchUtility constructor.
     * @param $request
     */
    public function __construct ($request)
    {
        $this->initialization($request);
    }

    /**
     * Initialization of request object
     * @param $request
     */
    private function initialization ($request)
    {
        foreach ( $request as $key => $value ) {
            $key = Str::camel();
            $this->$key = $value;
        }

        if ( isset($this->startTime) ) $this->startTime = strtotime($this->startTime);
        if ( isset($this->endTime) ) $this->endTime = strtotime($this->endTime);
    }

    /**
     * Base Query to search asset
     * @return mixed
     */
    protected function baseQueryForSlot ()
    {
        return AssetAvailability::where('start_timestamp', '<=', $this->startTime)
            ->where('end_timestamp', '>=', $this->endTime)
            ->whereDoesntHave('asset_lock', function ($query)
            {
                $query->whereBetween('start_timestamp', [$this->startTime, $this->endTime]);
                $query->whereBetween('end_timestamp', [$this->startTime, $this->endTime]);
                $query->whereBetween('expiry_timestamp', [$this->startTime, $this->endTime]);
            });
    }

    /**
     * Base query to find extension for a vehicle
     * @return mixed
     */
    public function baseExtensionQuery ()
    {
        return AssetAvailability::where('asset_detail_id', $this->assetDetailId)
            ->where('end_timestamp', '=', $this->endTime)
            ->whereDoesntHave('asset_lock', function ($query)
            {
                $query->whereBetween('start_timestamp', [$this->startTime, $this->endTime]);
                $query->whereBetween('end_timestamp', [$this->startTime, $this->endTime]);
                $query->whereBetween('expiry_timestamp', [$this->startTime, $this->endTime]);
            });
    }

    /**
     * Base query to find prepone period for a vehicle
     * @return mixed
     */
    public function basePreponeQuery ()
    {
        return AssetAvailability::where('asset_detail_id', $this->assetDetailId)
            ->where('start_timestamp', '=', $this->endTime)
            ->whereDoesntHave('asset_lock', function ($query)
            {
                $query->whereBetween('start_timestamp', [$this->startTime, $this->endTime]);
                $query->whereBetween('end_timestamp', [$this->startTime, $this->endTime]);
                $query->whereBetween('expiry_timestamp', [$this->startTime, $this->endTime]);
            });
    }
}