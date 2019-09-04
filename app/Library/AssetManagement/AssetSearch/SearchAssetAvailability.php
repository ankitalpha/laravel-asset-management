<?php

namespace Drivezy\LaravelAssetManager\Library\AssetManagement\AssetSearch;
/**
 * Class SearchAssetAvailability
 * @package Drivezy\LaravelAssetManager\Library\AssetManagement\AssetSearch
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class SearchAssetAvailability extends BaseSearch
{

    /**
     * Fetch one asset availability with/without venue reference.
     *
     * Required variable:
     * $vehicleIds (int) (single id)
     *
     * Optional variable:
     * $venueIds (int) (single id)
     *
     * @return mixed
     */
    public function hasOneAssetQuery ()
    {
        return $this->baseQueryForSlot()
            ->where('asset_detail_id', $this->vehicleIds)
            ->when(isset($this->venueIds), function ($q)
            {
                $q->where('venue_id', $this->venueIds);
            });
    }

    /**
     * Fetch many asset availability with/without venue reference.
     *
     * Required variable:
     * $vehicleIds (array) (multiple id)
     *
     * Optional variable:
     * $venueIds (array) (multiple id)
     *
     * @return mixed
     */
    public function hasManyAssetQuery ()
    {
        return $this->baseQueryForSlot()
            ->whereIn('asset_detail_id', $this->vehicleIds)
            ->when(isset($this->venueIds), function ($q)
            {
                $q->whereIn('venue_id', $this->venueIds);
            });
    }

    /**
     * Fetch one asset model availability with/without venue reference.
     *
     * Required variable:
     * $carIds (int) (single id)
     *
     * Optional variable:
     * $venueIds (int) (single id)
     *
     * @return mixed
     */
    public function hasOneAssetModelQuery ()
    {
        return $this->baseQueryForSlot()
            ->where('asset_category_id', $this->carIds)
            ->when(isset($this->venueIds), function ($q)
            {
                $q->where('venue_id', $this->venueIds);
            });
    }

    /**
     * Fetch many asset model availability with/without venue reference.
     *
     * Required variable:
     * $carIds (array) (multiple id)
     *
     * Optional variable:
     * $venueIds (array) (multiple id)
     *
     * @return mixed
     */
    public function hasManyAssetModelQuery ()
    {
        return $this->baseQueryForSlot()
            ->whereIn('asset_category_id', $this->carIds)
            ->when(isset($this->venueIds), function ($q)
            {
                $q->whereIn('venue_id', $this->venueIds);
            });
    }

    /**
     * Fetch all asset model availability on a venue.
     *
     * Required variable:
     * $venueId (int) (single id)
     *
     * Optional variable:
     * $car (int) (single id)
     *
     * @return mixed
     */
    public function getAssetAtOneVenueQuery ()
    {
        return $this->baseQueryForSlot()
            ->where('venue_id', $this->venueIds)
            ->when(isset($this->carIds), function ($q)
            {
                $q->where('asset_category_id', $this->carIds);
            });
    }

    /**
     * Fetch all asset model availability on a venue.
     *
     * Required variable:
     * $venueId (array) (multiple id)
     *
     * Optional variable:
     * $car (array) (multiple id)
     *
     * @return mixed
     */
    public function getAssetAtMultipleVenueQuery ()
    {
        return $this->baseQueryForSlot()
            ->whereIn('venue_id', $this->venueIds)
            ->when(isset($this->carIds), function ($q)
            {
                $q->whereIn('asset_category_id', $this->carIds);
            });
    }

    /**
     * Fetch extension limit
     * @return mixed
     */
    public function getExtensionLimit ()
    {
        return $this->baseExtensionQuery();
    }

    /**
     * Fetch prepone Limit
     * @return mixed
     */
    public function getPreponeLimit ()
    {
        return $this->basePreponeQuery();
    }
}