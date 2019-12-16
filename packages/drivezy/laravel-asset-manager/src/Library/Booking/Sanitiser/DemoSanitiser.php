<?php

namespace Drivezy\LaravelAssetManager\Library\Booking\Sanitiser;

use Drivezy\LaravelAssetManager\Library\Sanitiser;

/**
 * todo this is just a demo class to understand structure of RequestManagement framework
 * todo delete after you understand the structure
 *
 * Class DemoSanitiser
 * @package App\Library\Booking\Sanitiser
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class DemoSanitiser extends Sanitiser
{
    /**
     * @return array|null
     * @internal  Package make it mandatory to declare sanitise method in your class
     * by default it will be called first
     */
    public function handle ()
    {
    }
}