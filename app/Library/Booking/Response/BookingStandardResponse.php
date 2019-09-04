<?php

namespace Drivezy\LaravelAssetManager\Library\Booking\Response;
/**
 * Class BookingStandardResponse
 * @package ${NAMESPACE}
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 */
class BookingStandardResponse
{
    /**
     * @var null
     */
    protected $request = null;

    /**
     * StandardResponseManager constructor.
     * @param $request
     */
    public function __construct ($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function response ()
    {
        return $this->request->booking;
    }
}