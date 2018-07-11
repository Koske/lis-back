<?php

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends BaseController
{
    public function newProjectAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Project, null);

        return $handler->createProject($request);
    }
    public function getProjectAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Project, null);

        return $handler->getProjects();
    }
    public function getProjectPPAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Project, null);

        return $handler->getProjectsPerPage($request);
    }
    public function editProjectAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Project, null);

        return $handler->editProjects($request);
    }
    public function deleteProjectAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Project, null);


        return $handler->deleteProjects($request);
    }
    public function finishProjectAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Project, null);


        return $handler->finishProject($request);
    }
    public function filterProjectsAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Project, null);


        return $handler->filterProjects($request);
    }
    public function searchProjectsAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Project, null);


        return $handler->searchProjects($request);
    }
    public function getProjectByIdAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Project, null);


        return $handler->getProjectById($request);
    }

}