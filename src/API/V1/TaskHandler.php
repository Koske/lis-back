<?php

namespace App\API\V1;
use App\Entity\Etape;
use App\Entity\Participant;
use App\Entity\Project;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskHandler extends BaseHandler
{
    public function taskProjects(Request $request){
        $params = $this->getParams($request);
        if (!$params->etapeId || !$params->name || !$params->description || !$params->dateStarted || !$params->hour || !$params->participant) {


            return $this->getParameterMissingResponse();
        }

        $this->container->get('app.task')->createTask($params->etapeId, $params->name, $params->description, $params->dateStarted, $params->hour, $params->participant);

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

//    public function getTaskByEtape(Request $request){
//        $params = $this->getParams($request);
//
//        $tasks = $this->em->getRepository(Task::class)->findBy(
//            array('etape' => $this->em->getRepository(Etape::class)->find($params->etape_id))
//        );
//
//        return $this->getResponse([
//            'tasks' => $tasks
//        ]);
//    }

    public function getTaskById(Request $request){
        $params = $this->getParams($request);

        $task = $this->em->getRepository(Task::class)->find($params->id);

        return $this->getResponse([
           'task' => $task
        ]);
    }

    public function editTask(Request $request){
        $params = $this->getParams($request);


        $task = $this->em->getRepository(Task::class)->find(
            $params->id
        );
        $task->setName($params->name);
        $task->setDescription($params->description);
        $task->setStart(new \DateTime($params->start));

        $task->setHour($params->hour);
        $task->setParticipant($this->em->getRepository(Participant::class)->find($params->participant));

        $this->em->persist($task);
        $this->em->flush();

        return $this->getSuccessResponse();
    }


}