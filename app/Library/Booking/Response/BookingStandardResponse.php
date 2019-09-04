<?php

/**
 * Class BookingStandardResponse
 * @package ${NAMESPACE}
 *
 * @see  task on JIRA
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
    public function __construct ($request) {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function response () {
        return $this->request->booking;
    }
}