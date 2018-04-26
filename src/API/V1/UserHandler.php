<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.2.18.
 * Time: 17.29
 */

namespace App\API\V1;

use App\API\V1\Interfaces\IUserHandler;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class UserHandler extends BaseHandler implements IUserHandler
{
    function __construct(EntityManagerInterface $em, ContainerInterface $container, LoggerInterface $logger)
    {
        parent::__construct($em, $container, $logger);
    }

    public function getCurrentUser()
    {
        return $this->getResponse([
            'status' => 'ok',
            'user' => $this->getUser()
        ], Response::HTTP_OK);
    }
}