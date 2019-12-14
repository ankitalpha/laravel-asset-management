<?php

namespace App\Library\RecordManagement;

use Drivezy\LaravelAssetManager\Models\Address;
use Drivezy\LaravelAssetManager\Models\AssetDetail;
use Drivezy\LaravelUtility\LaravelUtility;

/**
 * Class AddressDetailManagement
 * @package App\Library\RecordManagement
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class AddressDetailManagement
{
    /**
     * Request input
     * @var array
     */
    private $request = [];

    /**
     * Response output
     * @var array
     */
    public $response = [];

    /**
     * Old address record that got modified
     * @var null
     */
    private $oldAddressRecord = null;

    /**
     * New address record that got created
     * @var null
     */
    private $newAddressRecord = null;

    /**
     * AddressRecordManagement constructor.
     * @param $request
     * @param $existingRecord
     */
    public function __construct ($request, $existingRecord = null)
    {
        $this->request = $request;
        $this->oldAddressRecord = $existingRecord;

        $this->process();
    }

    /**
     * Process request, there are 2 cases
     * 1. In case of new record creation it will simply create new address record against user.
     * 2. In case of address modification (updating) it will create new record with changes and rest field as same it was,
     *    then with parent_id of the record which is getting modified and we will inactive the record. And then change address_id
     *    in all the AssetDetail which was using it.
     */
    private function process ()
    {
        if ( $this->oldAddressRecord ) {
            $this->updateAddressRecord();
            $this->inactiveOldAddress();
            $this->changeAddressOnAssetDetail($this->oldAddressRecord->id, $this->newAddressRecord->id);
        } else {
            $this->createRecord();
        }

        if ( $this->newAddressRecord->errors )
            return $this->response = failure_message($this->newAddressRecord);

        return $this->response = success_message($this->newAddressRecord);
    }

    /**
     * Creates or updates the address record.
     *
     * @return null
     */
    private function createRecord ()
    {
        $this->newAddressRecord = new Address();

        foreach ( $this->request as $key => $value )
            $this->newAddressRecord->setAttribute($key, $value);

        $this->newAddressRecord->save();
    }

    /**
     * This method will delete the existing address and update the new address.
     */
    private function updateAddressRecord ()
    {
        $this->newAddressRecord = new Address();
        $columns = Utility::getColumns('utl_address_details', ['id']);

        foreach ( $columns as $column ) {
            $this->newAddressRecord->$column = $this->request[ $column ] ?? $this->oldAddressRecord->$column;
        }

        $this->newAddressRecord->parent_id = $this->oldAddressRecord->id;
        $this->newAddressRecord->save();
    }

    /**
     * @return bool
     */
    private function inactiveOldAddress ()
    {
        if ( isset($this->newAddressRecord->errors) && !$this->newAddressRecord ) {
            return false;
        }

        self::inactiveAddress($this->oldAddressRecord);
    }

    /**
     * This will change all the address attached to the AssetDetail in case of modification of the address
     */
    private function changeAddressOnAssetDetail ()
    {
        if ( isset($this->newAddressRecord->errors) ) {
            return false;
        }

        $assetDetails = AssetDetail::where('address_id', $this->oldAddressRecord->id)->get();

        foreach ( $assetDetails as $assetDetail ) {
            $assetDetail->address_id = $this->newAddressRecord->id;
            $assetDetail->save();
        }
    }

    /**
     * Validating if address request is valid
     *
     * @param $id address_id
     * @return array
     */
    public static function userAddressValidation ($id)
    {
        $address = Address::where('active', 1)
            ->where('source_type', md5(LaravelUtility::getUserModelFullQualifiedName()))
            ->where('source_id', Auth::id())
            ->find($id);

        if ( !$address ) {
            return failure_message('Address does not exist');
        }

        return success_message($address);
    }

    /**
     * Address inactive method
     * @param $address
     * @return The Address record.
     */
    public static function inactiveAddress ($address)
    {
        $address->active = false;
        $address->save();

        return $address;
    }
}