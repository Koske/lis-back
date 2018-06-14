<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.2.18.
 * Time: 20.15
 */

namespace App\EventListener\EntityListenerHandlers;


use App\Entity\User;

class EntityHandlerFactory
{
    public static function getHandler($entity, $container)
    {

        $listener = null;

        if($entity instanceof User)
        {

        }
        else {
            $listener = new BaseListenerHandler();
            $listener->setEntity($entity);

        }

        return $listener;
    }
}