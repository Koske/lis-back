<?php

namespace App\API\V1;
use App\Entity\Etape;
use App\Entity\Project;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskHandler extends BaseHandler
{
    public function taskProjects(Request $request){
        $params = $this->getParams($request);
        if (!$params->etapeId || !$params->name || !$params->description || !$params->dateStarted || !$params->hour) {


            return $this->getParameterMissingResponse();
        }

        $this->container->get('app.task')->createTask($params->etapeId, $params->name, $params->description, $params->dateStarted, $params->hour);

        return $this->getSuccessResponse();
    }
    public function getTasks(){
        $tasks = $this->container->get('app.task')->getAll();

        return $this->getResponse($tasks);
    }

    public function doneTask(Request $request){
        $params = $this->getParams($request);

        if (!$params->id) {


            return $this->getParameterMissingResponse();
        }

        $this->container->get('app.task')->taskDone($params->id);

        return $this->getSuccessResponse();
    }
}