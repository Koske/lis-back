<?php
/**
 * Created by PhpStorm.
 * User: milosa
 * Date: 4/26/2018
 * Time: 1:34 PM
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class PresenceController extends BaseController
{

    public function checkInAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Presence);

        return $handler->checkIn($request);
    }

    public function checkOutAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Presence);

        return $handler->checkOut($request);
    }

    public function userIsCheckedInAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Presence);

        return $handler->userIsCheckedIn($request);
    }

    public function getPresenceByUserAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Presence);

        return $handler->getPresenceByUser($request);
    }

    public function editPresenceAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Presence);

        return $handler->editPresence($request);
    }

    public function getEditedPresencesAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Presence);

        return $handler->getEditedPresences($request);
    }

}