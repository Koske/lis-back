<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 24.7.18.
 * Time: 11.56
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class ParticipantTypeController extends BaseController
{
    public function newParticipantTypeAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::ParticipantType);

        return $handler->newParticipantType($request);
    }

    public function removeParticipantTypeAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::ParticipantType);

        return $handler->removeParticipantType($request);
    }

    public function getAllParticipantTypesAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::ParticipantType);

        return $handler->getAllParticipantTypes();
    }
}