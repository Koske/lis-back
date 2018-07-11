<?php

namespace App\Service;


use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;

class ProjectService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function createProject($name, $description, $dateStarted, $estimatedDuration, $user){
        $project = new Project();
        $project->setDateCreated(new \DateTime());
        $project->setName($name);
        $project->setDeleted(false);
        $project->setDescription($description);
        $project->setStartDate(new \DateTime($dateStarted));
        $project->setEstimatedDuration(new \DateTime($estimatedDuration));
        $project->setFinished(false);
        $project->setUserCreated($user);
        $project->setDateCreated(new \DateTime());
        $project->setDateUpdated(new \DateTime());

        $this->em->persist($project);
        $this->em->flush();

        return true;
    }

    public function getAll() {
        return $this->em->getRepository(Project::class)->findBy([ 'deleted' => false ]);
    }

    public function editProject($id, $name, $description, $dateStarted, $estimatedDuration){
        $project = $this->em->getRepository(Project::class)->find(
            $id
        );
        $project->setName($name);
        $project->setDescription($description);
        $project->setStartDate(new \DateTime($dateStarted));
        $project->setEstimatedDuration(new \DateTime($estimatedDuration));
        $project->setDateUpdated(new \DateTime());
        $this->em->persist($project);
        $this->em->flush();

        return true;
    }


}