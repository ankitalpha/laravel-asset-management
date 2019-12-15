<?php

namespace App\Http\Controllers;

use Drivezy\LaravelAssetManager\Library\RecordManagement\AddressDetailManagement;
use Drivezy\LaravelAssetManager\Models\Address;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class VenueAddressController
 * @package App\Http\Controllers
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class VenueAddressController extends RecordController
{
    /**
     * @var Address model path.
     */
    protected $model = Address::class;


    /**
     * @param Request $request
     * @return mixed
     */
    public function index (Request $request)
    {
        $query = ( $request->has('query') && $request->get('query') ) ? $request->get('query') : '1=1';

        $baseQuery = $query . '`source_type` LIKE \'Venue\' AND `source_id`=' . Auth::id() . '`active` = 1';
        $request->request->set('query', $baseQuery);

        return parent::index($request);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed|null
     */
    public function update (Request $request, $id)
    {
        $request->request->set('source_type', 'Venue');

        return parent::update();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store (Request $request)
    {
        $request->request->set('source_type', 'Venue');

        return parent::store();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy (Request $request, $id)
    {
        $address = Address::where('id', $id)->where('source_type', 'Venue')->first();

        if ( !$address ) {
            return invalid_operation();
        }

        AddressDetailManagement::inactiveAddress($address);

        return success_response('Deleted address successfully');
    }
}