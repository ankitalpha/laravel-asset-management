<?php

namespace App\Http\Controllers;
use App\User;

/**
 * Class TestController
 * @package App\Http\Controllers
 *
 * @see  task on JIRA
 */
class TestController
{

    public function test ()
    {
//        return config('utility.app_namespace') . '\\User';
        return success_message('Why so serious');
    }
}