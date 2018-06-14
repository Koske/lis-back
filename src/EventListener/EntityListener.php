<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.2.18.
 * Time: 20.11
 */

namespace App\EventListener;

use App\EventListener\EntityListenerHandlers\EntityHandlerFactory;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Psr\Container\ContainerInterface;

class EntityListener
{
    private $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $handler = EntityHandlerFactory::getHandler($args->getEntity(), $this->container);

        if($handler == null)
        {
            return;
        }

        $handler->prePersist();
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $handler = EntityHandlerFactory::getHandler($args->getEntity(), $this->container);

        if($handler == null)
        {
            return;
        }

        $handler->preUpdate();
    }
}
