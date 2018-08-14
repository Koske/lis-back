<?php

namespace App\API\V1;


use App\Entity\Project;
use App\Entity\Etape;
use App\Entity\ProjectType;
use App\Entity\User;
use App\Model\ProjectFilter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectHandler extends BaseHandler
{
    public function createProject(Request $request){

        $params = $this->getParams($request);
        $user = $this->em->getRepository(User::class)->find($params->user->id);
        $projectType = $this->em->getRepository(ProjectType::class)->find($params->project->projectType);
        if (!$params->project->name || !$params->project->description || !$params->project->dateStarted || !$params->project->estimatedDuration || !$user || !$projectType) {


            return $this->getParameterMissingResponse();
        }

        $this->container->get('app.project')->createProject($params->project->name, $params->project->description, $params->project->dateStarted, $params->project->estimatedDuration, $user, $projectType);

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
        $projectFilter->setDeleted(false);

        $totalPages = 0;
        $projects = $elasticManager->getRepository(Project::class)->search($projectFilter);

        if($projects['total']%$perPage == 0){
            $totalPages = floor($projects['total'] / $perPage);
        }else {
            $totalPages = floor($projects['total'] / $perPage + 1);
        }





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
        $projectType = $this->em->getRepository(ProjectType::class)->find($params->projectType);

        if (!$params->id||!$params->name || !$params->description || !$params->dateStarted || !$params->estimatedDuration || !$projectType) {


            return $this->getParameterMissingResponse();
        }

        $this->container->get('app.project')->editProject($params->id, $params->name, $params->description, $params->dateStarted, $params->estimatedDuration, $projectType);

        return $this->getSuccessResponse();
    }

    public function deleteProjects(Request $request){
        $params = $this->getParams($request);

        if (!$params->id) {

            return $this->getParameterMissingResponse();
        }
        $project = $this->em->getRepository(Project::class)->find(
            $params->id
        );
        $project->setDeleted(true);
        $project->setDateUpdated(new \DateTime());
        $this->em->persist($project);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function finishProject(Request $request){
        $params = $this->getParams($request);

        $project = $this->em->getRepository(Project::class)->find($params->id);
        $project->setFinished(true);
        $project->setDateUpdated(new \DateTime());
        $project->setEndDate(new \DateTime());
        $this->em->persist($project);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function filterProjects(Request $request){


        $elasticManager = $this->container->get('fos_elastica.manager');
        $params = $this->getParams($request);
        $perPage = $params->perPage;
        $page = $params->page;
        $projectFilter = new ProjectFilter();
        $projectFilter->setPerPage($params->perPage);
        $projectFilter->setPage($params->page);
        $projectFilter->setDeleted(false);
        $projectFilter->setFinished($params->finished);
        $projectFilter->setDateFrom($params->startDate);
        $projectFilter->setDateTo($params->endDate);
        $projectFilter->setType($params->dates);
        $projects = $elasticManager->getRepository(Project::class)->search($projectFilter);
        $totalPages = 0;

        if($projects['total']%$perPage == 0){
            $totalPages = floor($projects['total'] / $perPage);
        }else {
            $totalPages = floor($projects['total'] / $perPage + 1);
        }



        return $this->getResponse([
            'projects' => $projects['result'],
            'total' => $projects['total'],
            'perPage' => $perPage,
            'page' => $page,
            'total_pages' => $totalPages
        ]);
    }

    public function searchProjects(Request $request)
    {
        $elasticManager = $this->container->get('fos_elastica.manager');
        $params = $this->getParams($request);
        $perPage = $params->perPage;
        $page = $params->page;
        $finished = $params->finished;
        $search_term = $params->searchTerm;
        $projectFilter = new ProjectFilter();

        $projectFilter->setSearchTerm($search_term);
        $projectFilter->setPerPage($perPage);
        $projectFilter->setPage($page);
        $projectFilter->setDeleted(0);
        $projectFilter->setFinished($finished);


        $projects = $elasticManager->getRepository(Project::class)->search($projectFilter);

        $totalPages = 0;

        if($projects['total']%$perPage == 0){
            $totalPages = floor($projects['total'] / $perPage);
        }else {
            $totalPages = floor($projects['total'] / $perPage + 1);
        }


        return $this->getResponse([
            'projects' => $projects['result'],
            'total' => $projects['total'],
            'searchTerm' => $search_term,
            'perPage' => $perPage,
            'page' => $page,
            'total_pages' => $totalPages
        ]);
    }

    public function getProjectById(Request $request){
        $params = $this->getParams($request);

        $project = $this->em->getRepository(Project::class)->find($params->id);
        $startDate = $project->getStartDate()->format('Y-m-d');
        $endDate = $project->getEstimatedDuration()->format('Y-m-d');
        return $this->getResponse([
            'project' => $project,
            'start' => $startDate,
            'end' => $endDate
        ]);

    }





}