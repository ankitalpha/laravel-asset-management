<?php

namespace App\Library\RecordManagement;

use Drivezy\LaravelAssetManager\Models\AssetLock;

/**
 * Class AssetLockManagement
 * @package Drivezy\LaravelAssetManager\Library\RecordManagment
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AssetLockManagement
{

    /**
     * The request variable.
     * var array|null
     */
    public $request = null;

    /**
     * @var null
     */
    public $assetLock = null;

    /**
     * AssetLockManagement constructor.
     * @param $request array
     * @param $record object|null
     */
    public function __construct ($request, $record = null)
    {
        $this->request = $request;
        $this->assetLock = $record;
    }

    /**
     * Creates record
     * @return null
     */
    public function create ()
    {
        $this->assetLock = new AssetLock();

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
            $this->assetLock->setAttributes($key, $value);

        $this->assetLock->start_timestamp = strtotime($this->assetLock->start_time);
        $this->assetLock->end_timstamp = strtotime($this->assetLock->end_time);
        $this->assetLock->expiry_timestatmp = strtotime($this->assetLock->expiry_time);

        $this->assetLock->save();

        return $this->assetLock;
    }
}