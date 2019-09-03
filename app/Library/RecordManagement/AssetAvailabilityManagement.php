<?php

namespace App\Library\RecordManagement;
use Drivezy\LaravelAssetManager\Models\AssetAvailability;
use Drivezy\LaravelAssetManager\Models\AssetLock;

/**
 * Class AssetAvailabilityManagement
 * @package Drivezy\LaravelAssetManager\Library\RecordManagment
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetAvailabilityManagement
{

    /**
     * The request variable.
     * var array|null
     */
    public $request = null;

    /**
     * @var null
     */
    public $assetAvailability = null;

    /**
     * AssetAvailabilityManagement constructor.
     * @param $request array
     * @param $record object|null
     */
    public function __construct ($request, $record = null)
    {
        $this->request = $request;
        $this->assetAvailability = $record;
    }

    /**
     * Creates record
     * @return null
     */
    public function create ()
    {
        $this->assetAvailability = new AssetAvailability();

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
            $this->assetAvailability->setAttributes($key, $value);

        $this->assetAvailability->start_timestamp = strtotime($this->assetAvailability->start_time);
        $this->assetAvailability->end_timstamp = strtotime($this->assetAvailability->end_time);
        $this->assetAvailability->duration = DateUtil::getDateTimeDifference($this->assetAvailability->expiry_time);

        $this->assetAvailability->save();

        return $this->assetAvailability;
    }
}