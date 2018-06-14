<?php

namespace App\Service;
use App\Entity\Etape;
use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;

class EtapeService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function createEtape($id, $name, $description, $dateStarted, $dateEnded){
        $project = $this->em->getRepository(Project::class)->find(
            $id
        );

        $etape = new Etape();
        $etape->setName($name);
        $etape->setDescription($description);
        $etape->setStart(new \DateTime($dateStarted));
        $etape->setEnd(new \DateTime($dateEnded));
        $etape->setProject($project);

        $this->em->persist($etape);
        $this->em->flush();

        return true;
    }

    public function getAll(){
        return $this->em->getRepository(Etape::class)->findAll();
    }
}