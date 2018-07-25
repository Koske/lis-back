<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 20.7.18.
 * Time: 16.18
 */

namespace App\API\V1;


use App\Entity\DayOff;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class DaysOffHandler extends BaseHandler
{
    public function newDaysOff(Request $request){
        $params = $this->getParams($request);

        $daysOff = new DayOff();

        $user= $this->em->getRepository(User::class)->find($params->userId);
        $daysOff->setStart(new \DateTime($params->start));
        $daysOff->setEnd(new \DateTime($params->end));
        $daysOff->setDeleted(false);
        $daysOff->setUser($user);
        $daysOff->setDateCreated(new \DateTime());
        $daysOff->setDateUpdated(new \DateTime());

        $this->em->persist($daysOff);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getDaysOff(){
        $daysOff = $this->em->getRepository(DayOff::class)->findBy([
            'deleted'=> false
        ]);

        return $this->getResponse([
            'daysOff'=> $daysOff
        ]);
    }

    public function removeDaysOff(Request $request){
        $params = $this->getParams($request);

        $daysOff = $this->em->getRepository(DayOff::class)->find($params->id);

        $daysOff->setDeleted(true);

        $this->em->persist($daysOff);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function editDaysOff(Request $request){
        $params = $this->getParams($request);
        $dayOff = $this->em->getRepository(DayOff::class)->find($params->daysOff->daysOffId);
        $user = $this->em->getRepository(User::class)->find($params->daysOff->userId);
        $dayOff->setUser($user);
        $dayOff->setStart(new \DateTime($params->daysOff->start));
        $dayOff->setEnd(new \DateTime($params->daysOff->end));

        $this->em->persist($dayOff);
        $this->em->flush();

        return $this->getSuccessResponse();

    }

    public function getDayOffById(Request $request){
        $params = $this->getParams($request);

        $dayOff = $this->em->getRepository(DayOff::class)->find($params->id);

        return $this->getResponse([
            'dayOff'=> $dayOff
        ]);
    }
}