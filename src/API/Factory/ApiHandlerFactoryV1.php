<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.2.18.
 * Time: 17.26
 */

namespace App\API\Factory;


use App\API\HandlerType;
use App\API\V1\PresenceHandler;
use App\API\V1\UserHandler;

class ApiHandlerFactoryV1
{

    public function getHandler($type, $em, $container, $logger)
    {
        if ($type == HandlerType::User) {
            return new UserHandler($em, $container, $logger);
        }

        if ($type == HandlerType::Presence) {
            return new PresenceHandler($em, $container, $logger);
        }
        return null;
    }
}