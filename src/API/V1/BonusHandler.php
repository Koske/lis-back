<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 20.7.18.
 * Time: 11.26
 */

namespace App\API\V1;


use App\Entity\Bonus;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class BonusHandler extends BaseHandler
{
    public function newBonus(Request $request){
        $params = $this->getParams($request);

        $user = $this->em->getRepository(User::class)->find($params->userId);
        $exists = $this->em->getRepository(Bonus::class)->findBy([
            'user'=> $user
        ]);
        if(!$exists){
            $bonus = new Bonus();
            $bonus->setUser($user);
            $bonus->setDeleted(false);
            $bonus->setDateCreated(new \DateTime());
            $bonus->setDateUpdated(new \DateTime());
            $bonus->setValue($params->value);
            $bonus->setDate(new \DateTime($params->date));

            $this->em->persist($bonus);
            $this->em->flush();

            return $this->getSuccessResponse();
        }else{
            return $this->getResponse(['Exists']);
        }
    }

    public function getBonuses(){
        $bonuses = $this->em->getRepository(Bonus::class)->findBy(['deleted'=> false]);

        return $this->getResponse(['bonuses'=> $bonuses]);
    }

    public function removeBonus(Request $request){
        $params = $this->getParams($request);

        $bonus = $this->em->getRepository(Bonus::class)->find($params->id);
        $bonus->setDeleted(true);

        $this->em->persist($bonus);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getBonusById(Request $request){
        $params = $this->getParams($request);

        $bonus = $this->em->getRepository(Bonus::class)->find($params->id);

        return $this->getResponse(['bonus'=> $bonus]);
    }

    public function editBonus(Request $request){
        $params = $this->getParams($request);

        $user = $this->em->getRepository(User::class)->find($params->userId);
        $bonus = $this->em->getRepository(Bonus::class)->find($params->bonusId);


        $bonus->setValue($params->value);
        $bonus->setUser($user);
        $bonus->setDate(new \DateTime($params->date));
        $bonus->setDateCreated(new \DateTime());
        $bonus->setDateUpdated(new \DateTime());

        $this->em->persist($bonus);
        $this->em->flush();

        return $this->getSuccessResponse();

    }

}