<?php

namespace Drivezy\LaravelAssetManager\Library\RecordManagement;

use Drivezy\LaravelAssetManager\Models\AssetBooking;
use Drivezy\LaravelUtility\LaravelUtility;

/**
 * Class AssetBookingManagement
 * @package Drivezy\LaravelAssetManager\Library\RecordManagment
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetBookingManagement
{

    /**
     * The request variable.
     * var array|null
     */
    public $request = null;

    /**
     * @var null
     */
    public $assetBooking = null;

    /**
     * AssetBookingManagement constructor.
     * @param $request array
     * @param $record object|null
     */
    public function __construct ($request, $record = null)
    {
        $this->request = $request;
        $this->assetBooking = $record;
    }

    /**
     * Creates record
     * @return null
     */
    public function create ()
    {
        $this->assetBooking = new AssetBooking();

        return $this->setAttributes();
    }

    /**
     * Update record
     * @return null
     */
    public function update ()
    {
        return $this->setAttributes();
    }

    /**
     * Set attributes of record and save it.
     * @return null
     */
    private function setAttributes ()
    {
        foreach ( $this->request as $key => $value )
            $this->assetBooking->setAttributes($key, $value);

        //todo change it with random number generator
        $this->request->reference_number = LaravelUtility::generateRandomAlphaNumeric(12);
        $this->assetBooking->save();

        return $this->assetBooking;
    }
}