<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 24.7.18.
 * Time: 11.55
 */

namespace App\API\V1;


use App\Entity\ParticipantType;
use Symfony\Component\HttpFoundation\Request;

class ParticipantTypeHandler extends BaseHandler
{
    public function newParticipantType(Request $request){
        $params = $this->getParams($request);

        $participantType = new ParticipantType();

        $participantType->setName($params->name);
        $participantType->setDescription($params->description);
        $participantType->setDateCreated(new \DateTime());
        $participantType->setDateUpdated(new \DateTime());
        $participantType->setDeleted(false);

        $this->em->persist($participantType);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function removeParticipantType(Request $request){
        $params = $this->getParams($request);

        $participantType = $this->em->getRepository(ParticipantType::class)->find($params->id);
        $participantType->setDeleted(true);
        $participantType->setDateUpdated(new \DateTime());

        $this->em->persist($participantType);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getAllParticipantTypes(){
        $participantTypes = $this->em->getRepository(ParticipantType::class)->findBy([
            'deleted'=> false
        ]);

        return $this->getResponse(['participantTypes'=> $participantTypes]);
    }
}