<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 24.7.18.
 * Time: 10.52
 */

namespace App\API\V1;


use App\Entity\ProjectType;
use Symfony\Component\HttpFoundation\Request;

class ProjectTypeHandler extends BaseHandler
{
    public function newProjectType(Request $request){
        $params = $this->getParams($request);

        $projectType = new ProjectType();

        $projectType->setName($params->name);
        $projectType->setDescription($params->description);
        $projectType->setDateCreated(new \DateTime());
        $projectType->setDateUpdated(new \DateTime());
        $projectType->setDeleted(false);

        $this->em->persist($projectType);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getProjectTypes(){
        $projectTypes = $this->em->getRepository(ProjectType::class)->findBy([
            'deleted'=> false
        ]);

        return $this->getResponse(['projectTypes'=> $projectTypes]);
    }

    public function removeProjectType(Request $request){
        $params = $this->getParams($request);

        $projectType = $this->em->getRepository(ProjectType::class)->find($params->id);

        $projectType->setDeleted(true);

        $this->em->persist($projectType);
        $this->em->flush();

        return $this->getSuccessResponse();
    }
}