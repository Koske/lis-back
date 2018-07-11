<?php

namespace App\Controller;

use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class EtapeController extends BaseController
{
    public function newEtapeProjectAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Etape, null);


        return $handler->newEtapeProjects($request);
    }
    public function getEtapesAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Etape, null);


        return $handler->getEtapes($request);
    }
    public function getEtapeHoursAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Etape, null);


        return $handler->setHours($request);
    }
    public function getEtapeByIdAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Etape, null);


        return $handler->getEtapeById($request);
    }
    public function editEtapeAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Etape, null);


        return $handler->editEtape($request);
    }
    public function getEtapeByProjectAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Etape, null);


        return $handler->getEtapeByProject($request);
    }
}