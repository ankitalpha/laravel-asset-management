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
     * $assetDetailIds (int) (single id)
     *
     * Optional variable:
     * $venueIds (int) (single id)
     *
     * @return mixed
     */
    public function hasOneAssetQuery ()
    {
        return $this->baseQueryForSlot()
            ->where('asset_detail_id',$this->assetDetailIds)
            ->when(isset($this->venueIds), function ($q)
            {
                $q->where('venue_id', $this->venueIds);
            });
    }

    /**
     * Fetch many asset availability with/without venue reference.
     *
     * Required variable:
     * $assetDetailIds (array) (multiple id)
     *
     * Optional variable:
     * $venueIds (array) (multiple id)
     *
     * @return mixed
     */
    public function hasManyAssetQuery ()
    {
        return $this->baseQueryForSlot()
            ->whereIn('asset_detail_id',$this->assetDetailIds)
            ->when(isset($this->venueIds), function ($q)
            {
                $q->whereIn('venue_id', $this->venueIds);
            });
    }

    /**
     * Fetch one asset model availability with/without venue reference.
     *
     * Required variable:
     * $categoryIds (int) (single id)
     *
     * Optional variable:
     * $venueIds (int) (single id)
     *
     * @return mixed
     */
    public function hasOneAssetModelQuery ()
    {
        return $this->baseQueryForSlot()
            ->where('asset_category_id', $this->categoryIds)
            ->when(isset($this->venueIds), function ($q)
            {
                $q->where('venue_id', $this->venueIds);
            });
    }

    /**
     * Fetch many asset model availability with/without venue reference.
     *
     * Required variable:
     * $categoryIds (array) (multiple id)
     *
     * Optional variable:
     * $venueIds (array) (multiple id)
     *
     * @return mixed
     */
    public function hasManyAssetModelQuery ()
    {
        return $this->baseQueryForSlot()
            ->whereIn('asset_category_id', $this->categoryIds)
            ->when(isset($this->venueIds), function ($q)
            {
                $q->whereIn('venue_id', $this->venueIds);
            });
    }

    /**
     * Fetch all asset model availability on a venue.
     *
     * Required variable:
     * $venueIds (int) (single id)
     *
     * Optional variable:
     * $categoryIds (int) (single id)
     *
     * @return mixed
     */
    public function getAssetAtOneVenueQuery ()
    {
        return $this->baseQueryForSlot()
            ->where('venue_id', $this->venueIds)
            ->when(isset($this->categoryIds), function ($q)
            {
                $q->where('asset_category_id', $this->categoryIds);
            });
    }

    /**
     * Fetch all asset model availability on a venue.
     *
     * Required variable:
     * $venueIds (array) (multiple id)
     *
     * Optional variable:
     * $categoryIds (array) (multiple id)
     *
     * @return mixed
     */
    public function getAssetAtMultipleVenueQuery ()
    {
        return $this->baseQueryForSlot()
            ->whereIn('venue_id', $this->venueIds)
            ->when(isset($this->categoryIds), function ($q)
            {
                $q->whereIn('asset_category_id', $this->categoryIds);
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