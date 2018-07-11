<?php

namespace App\Service;

use App\Entity\Etape;
use App\Entity\Participant;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

class TaskService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function createTask($id, $name, $description, $dateStarted, $hour, $participant){
        $etape = $this->em->getRepository(Etape::class)->find($id);
        $project = $etape->getProject();
        $participantObj = $this->em->getRepository(Participant::class)->find($participant);

        $task = new Task();
        $task->setName($name);
        $task->setProject($project);
        $task->setDescription($description);
        $task->setDateCreated(new \DateTime());
        $task->setStart(new \DateTime($dateStarted));
        $task->setHour($hour);
        $task->setDeleted(false);
        $task->setEtape($etape);

        $task->setParticipant($participantObj);

        $this->em->persist($task);
        $this->em->flush();

        return true;
    }

    public function getAll(){
        return $this->em->getRepository(Task::class)->findAll();
    }

    public function taskDone($id){
        $task = $this->em->getRepository(Task::class)->find($id);
        $task->setEnd(new \DateTime());

        $this->em->persist($task);
        $this->em->flush();

        return true;
    }
}