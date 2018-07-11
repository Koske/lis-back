<?php

namespace App\API\V1;

use App\Entity\Etape;
use App\Entity\Project;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EtapeHandler extends BaseHandler
{
    public function newEtapeProjects(Request $request){
        $params = $this->getParams($request);

        if (!$params->projectId || !$params->name || !$params->description || !$params->dateStarted || !$params->dateEnded) {


            return $this->getParameterMissingResponse();
        }

        $this->container->get('app.etape')->createEtape($params->projectId ,$params->name, $params->description, $params->dateStarted, $params->dateEnded);

        return $this->getSuccessResponse();
    }

    public function getEtapes(){
        $etapes =  $this->container->get('app.etape')->getAll();

        return $this->getResponse($etapes);
    }

    public function setHours(Request $request){
        $params = $this->getParams($request);
        $etapes = $this->em->getRepository(Etape::class)->findBy(array(
                'project' => $params->project_id));


        foreach ($etapes as $el){

            $tasks = $this->em->getRepository(Task::class)->findBy(array(
                'etape' => $el));

            $countNotComp = 0;
            $countComp = 0;
            $hoursCompleted = 0;
            $hoursNotCompleted = 0;
            foreach($tasks as $t){
                if($t->getEnd()){
                    $countComp++;
                    $hoursCompleted+= $t->getHour();
                }else{
                    $countNotComp++;
                    $hoursNotCompleted+= $t->getHour();
                }

            }
            $el->setHoursCompleted($hoursCompleted);
            $el->setHoursNotCompleted($hoursNotCompleted);
            $el->setTasksCompleted($countComp);
            $el->setTasksNotCompleted($countNotComp);

            $this->em->persist($el);
            $this->em->flush();

        }
        return $this->getSuccessResponse();
    }

    public function getEtapeById(Request $request){
        $params = $this->getParams($request);

        $etape = $this->em->getRepository(Etape::class)->find($params->id);

        return $this->getResponse([
            'etape' => $etape
        ]);
    }

    public function editEtape(Request $request){
        $params = $this->getParams($request);
        $etape = $this->em->getRepository(Etape::class)->find($params->etape->id);
        $etape->setName($params->etape->name);
        $etape->setDescription($params->etape->description);
        $etape->setStart(new \DateTime($params->etape->dateStarted));
        $etape->setEnd(new \DateTime($params->etape->dateEnded));


        $this->em->persist($etape);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getEtapeByProject(Request $request){
        $params = $this->getParams($request);

        $project = $this->em->getRepository(Project::class)->find($params->id);
        $etapes = $this->em->getRepository(Etape::class)->findBy([
            'project' => $project
        ]);
        return $this->getResponse([
            'etapes' => $etapes
        ]);
    }

}