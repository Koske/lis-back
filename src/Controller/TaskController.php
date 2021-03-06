<?php

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;


class TaskController extends BaseController
{
    public function taskProjectAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Task, null);


        return $handler->taskProjects($request);
    }
    public function getTaskAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Task, null);


        return $handler->getTasks();
    }
    public function doneTaskAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Task, null);


        return $handler->doneTask($request);
    }
    public function getTaskByIdAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Task, null);


        return $handler->getTaskById($request);
    }
    public function editTaskAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Task, null);


        return $handler->editTask($request);
    }
    public function getTaskByEtapeAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Task, null);


        return $handler->getTaskByEtape($request);
    }
    public function getTaskForParticipantAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Task, null);


        return $handler->getTaskForParticipant($request);
    }
    public function removeTaskAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Task, null);


        return $handler->removeTask($request);
    }
}