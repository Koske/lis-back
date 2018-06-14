<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 10.5.18.
 * Time: 16.36
 */

namespace App\Controller;

use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class ParticipantController extends BaseController
{
    public function getParticipantAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Participant, null);

        return $handler->getParticipants($request);
    }
    public function getNoneParticipantAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Participant, null);

        return $handler->getNotParticipants($request);
    }
    public function addParticipantAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Participant, null);

        return $handler->addParticipant($request);
    }
    public function removeParticipantAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Participant, null);

        return $handler->removeParticipant($request);
    }
    public function getParticipantForProjectAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Participant, null);

        return $handler->getParticipantsForProject($request);
    }
    public function getParticipantTypesAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Participant, null);

        return $handler->getParticipantType();
    }
    public function getParticipantForTaskAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Participant, null);

        return $handler->getParticipantForTask($request);
    }
}