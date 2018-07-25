<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 24.7.18.
 * Time: 16.02
 */

namespace App\API\V1;


use App\Entity\Position;
use Symfony\Component\HttpFoundation\Request;

class PositionHandler extends BaseHandler
{
    public function newPosition(Request $request){
        $params = $this->getParams($request);

        $position = new Position();

        $position->setName($params->name);
        $position->setDescription($params->description);
        $position->setDeleted(false);
        $position->setDateCreated(new \DateTime());
        $position->setDateUpdated(new \DateTime());

        $this->em->persist($position);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getPositions(){
        $positions = $this->em->getRepository(Position::class)->findBy([
            'deleted'=> false
        ]);

        return $this->getResponse(['positions'=> $positions]);
    }

    public function removePosition(Request $request){
        $params = $this->getParams($request);

        $position = $this->em->getRepository(Position::class)->find($params->id);

        $position->setDeleted(true);
        $position->setDateUpdated(new \DateTime());

        $this->em->persist($position);
        $this->em->flush();

        return $this->getSuccessResponse();

    }
}