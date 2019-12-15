<?php

namespace Drivezy\LaravelAssetManager\Controllers;

use Drivezy\LaravelAssetManager\Library\RecordManagement\AddressDetailManagement;
use Drivezy\LaravelRecordManager\Controllers\RecordController;
use Drivezy\LaravelAssetManager\Models\Address;
use Drivezy\LaravelUtility\LaravelUtility;

/**
 * Class UserAddressController
 * @package Drivezy\LaravelAssetManager\Controllers
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class UserAddressController extends RecordController
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

        $baseQuery = $query . '`source_type` LIKE \'' . md5(LaravelUtility::getUserModelFullQualifiedName()) . '\' AND `source_id`=' . Auth::id() . '`active` = 1';
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
        $result = AddressDetailManagement::userAddressValidation($id);

        if ( !$result['success'] ) {
            return fixed_response($result['response']);
        }

        $address = new AddressDetailManagement($request->all(), $result['response']);

        return fixed_response($address->response);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store (Request $request)
    {
        $address = new AddressDetailManagement(array_merge($request->all(), ['source_type' => 'User', 'source_id' => Auth::id()]));

        return fixed_response($address->response);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy (Request $request, $id)
    {
        $result = AddressDetailManagement::userAddressValidation($id);

        if ( !$result['success'] ) {
            return fixed_response($result['response']);
        }

        AddressDetailManagement::inactiveAddress($result['response']);

        return success_response('Deleted address successfully');
    }
}