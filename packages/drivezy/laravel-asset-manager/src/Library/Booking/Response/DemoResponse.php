<?php

namespace Drivezy\LaravelAssetManager\Library\Booking\Response;
/**
 * todo this is just a demo class to understand structure of RequestManagement framework
 * todo delete after you understand the structure
 *
 * Class DemoResponse
 * @package ${NAMESPACE}
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari  ankit19.alpha@gmail.com>
 */
class DemoResponse
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
        return $this->request->response;
    }
}