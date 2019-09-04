<?php

namespace App\Http\Controllers;

use App\User;

/**
 * Class TestController
 * @package App\Http\Controllers
 */
class TestController
{

    public function test ()
    {
        return success_message('Why so serious');
    }
}