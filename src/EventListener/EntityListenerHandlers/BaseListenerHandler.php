<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.2.18.
 * Time: 20.17
 */

namespace App\EventListener\EntityListenerHandlers;


class BaseListenerHandler
{
    protected $entity;

    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    public function prePersist()
    {
        $this->entity->setDateCreated(new \DateTime());
        $this->entity->setDateUpdated(new \DateTime());
        $this->entity->setDeleted(false);
    }

    public function preUpdate()
    {
        $this->entity->setDateUpdated(new \DateTime());
    }
}