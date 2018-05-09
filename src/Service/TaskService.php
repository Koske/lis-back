<?php

namespace App\Service;

use App\Entity\Etape;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

class TaskService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function createTask($id, $name, $description, $dateStarted, $hour){
        $etape = $this->em->getRepository(Etape::class)->find($id);


        $task = new Task();
        $task->setName($name);
        $task->setDescription($description);
        $task->setDateCreated(new \DateTime());
        $task->setStart(new \DateTime($dateStarted));
        $task->setHour($hour);
        $task->setEtape($etape);

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