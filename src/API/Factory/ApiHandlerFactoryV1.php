<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.2.18.
 * Time: 17.26
 */

namespace App\API\Factory;


use App\API\HandlerType;
use App\API\V1\EtapeHandler;
use App\API\V1\ParticipantHandler;
use App\API\V1\PresenceHandler;
use App\API\V1\ProjectHandler;
use App\API\V1\ReportHandler;
use App\API\V1\TaskHandler;
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

        if($type == HandlerType::Project)
        {
            return new ProjectHandler( $em, $container, $logger);
        }

        if($type == HandlerType::Etape)
        {
            return new EtapeHandler( $em, $container, $logger);
        }

        if($type == HandlerType::Task) {
            return new TaskHandler($em, $container, $logger);
        }

        if($type == HandlerType::Participant) {
            return new ParticipantHandler($em, $container, $logger);
        }

        if($type == HandlerType::Report) {
            return new ReportHandler($em, $container, $logger);
        }
        return null;
    }
}