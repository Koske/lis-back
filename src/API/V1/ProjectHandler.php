<?php

namespace App\API\V1;


use App\Entity\Project;
use App\Entity\Etape;
use App\Model\ProjectFilter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectHandler extends BaseHandler
{
    public function createProject(Request $request){

        $params = $this->getParams($request);

        if (!$params->name || !$params->description || !$params->dateStarted || !$params->estimatedDuration) {


            return $this->getParameterMissingResponse();
        }

        $this->container->get('app.project')->createProject($params->name, $params->description, $params->dateStarted, $params->estimatedDuration);

        return $this->getSuccessResponse();
    }

    public function getProjects(){

        $projects = $this->container->get('app.project')->getAll();

        return $this->getResponse($projects);
    }

    public function getProjectsPerPage(Request $request){

        $page = $request->get('page');
        $perPage = $request->get('perPage');
        $elasticManager = $this->container->get('fos_elastica.manager');

        $projectFilter = new ProjectFilter();
        $projectFilter->setPerPage($perPage);
        $projectFilter->setPage($page);
        $projectFilter->setDeleted(0);

        $projects = $elasticManager->getRepository(Project::class)->search($projectFilter);
        $totalPages = floor($projects['total'] / $perPage + 1);



        return $this->getResponse([
            'projects' => $projects['result'],
            'total' => $projects['total'],
            'perPage' => $perPage,
            'page' => $page,
            'total_pages' => $totalPages
        ]);
    }


    public function editProjects(Request $request){
        $params = $this->getParams($request);

        if (!$params->id||!$params->name || !$params->description || !$params->dateStarted || !$params->estimatedDuration) {


            return $this->getParameterMissingResponse();
        }

        $this->container->get('app.project')->editProject($params->id, $params->name, $params->description, $params->dateStarted, $params->estimatedDuration);

        return $this->getSuccessResponse();
    }

    public function deleteProjects(Request $request){
        $params = $this->getParams($request);

        if (!$params->id) {

            return $this->getParameterMissingResponse();
        }
        $this->container->get('app.project')->deleteProject($params->id);

        return $this->getSuccessResponse();
    }





}