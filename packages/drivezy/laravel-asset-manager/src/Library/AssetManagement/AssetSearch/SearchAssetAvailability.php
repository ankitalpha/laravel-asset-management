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
     * Fetch one asset availability with/without address reference.
     *
     * Required variable:
     * $assetDetailIds (int) (single id)
     *
     * Optional variable:
     * $addressIds (int) (single id)
     *
     * @return mixed
     */
    public function hasOneAssetQuery ()
    {
        return $this->baseQueryForSlot()
            ->where('asset_detail_id', $this->assetDetailIds)
            ->when(isset($this->addressIds), function ($q) {
                $q->where('address_id', $this->addressIds);
            });
    }

    /**
     * Fetch many asset availability with/without address reference.
     *
     * Required variable:
     * $assetDetailIds (array) (multiple id)
     *
     * Optional variable:
     * $addressIds (array) (multiple id)
     *
     * @return mixed
     */
    public function hasManyAssetQuery ()
    {
        return $this->baseQueryForSlot()
            ->whereIn('asset_detail_id', $this->assetDetailIds)
            ->when(isset($this->addressIds), function ($q) {
                $q->whereIn('address_id', $this->addressIds);
            });
    }

    /**
     * Fetch one asset model availability with/without address reference.
     *
     * Required variable:
     * $categoryIds (int) (single id)
     *
     * Optional variable:
     * $addressIds (int) (single id)
     *
     * @return mixed
     */
    public function hasOneAssetModelQuery ()
    {
        return $this->baseQueryForSlot()
            ->where('asset_category_id', $this->categoryIds)
            ->when(isset($this->addressIds), function ($q) {
                $q->where('address_id', $this->addressIds);
            });
    }

    /**
     * Fetch many asset model availability with/without address reference.
     *
     * Required variable:
     * $categoryIds (array) (multiple id)
     *
     * Optional variable:
     * $addressIds (array) (multiple id)
     *
     * @return mixed
     */
    public function hasManyAssetModelQuery ()
    {
        return $this->baseQueryForSlot()
            ->whereIn('asset_category_id', $this->categoryIds)
            ->when(isset($this->addressIds), function ($q) {
                $q->whereIn('address_id', $this->addressIds);
            });
    }

    /**
     * Fetch all asset model availability on a address.
     *
     * Required variable:
     * $addressIds (int) (single id)
     *
     * Optional variable:
     * $categoryIds (int) (single id)
     *
     * @return mixed
     */
    public function getAssetAtOneAddressQuery ()
    {
        return $this->baseQueryForSlot()
            ->where('address_id', $this->addressIds)
            ->when(isset($this->categoryIds), function ($q) {
                $q->where('asset_category_id', $this->categoryIds);
            });
    }

    /**
     * Fetch all asset model availability on a address.
     *
     * Required variable:
     * $addressIds (array) (multiple id)
     *
     * Optional variable:
     * $categoryIds (array) (multiple id)
     *
     * @return mixed
     */
    public function getAssetAtMultipleAddressQuery ()
    {
        return $this->baseQueryForSlot()
            ->whereIn('address_id', $this->addressIds)
            ->when(isset($this->categoryIds), function ($q) {
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