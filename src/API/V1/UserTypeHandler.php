<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 24.7.18.
 * Time: 13.58
 */

namespace App\API\V1;


use App\Entity\UserType;
use Symfony\Component\HttpFoundation\Request;

class UserTypeHandler extends BaseHandler
{
    public function newUserType(Request $request){
        $params = $this->getParams($request);

        $userType = new UserType();

        $userType->setName($params->name);
        $userType->setType($params->type);
        $userType->setDeleted(false);
        $userType->setDateCreated(new \DateTime());
        $userType->setDateUpdated(new \DateTime());

        $this->em->persist($userType);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getUserTypes(){
        $userTypes = $this->em->getRepository(UserType::class)->findBy([
            'deleted'=> false
        ]);

        return $this->getResponse(['userTypes'=> $userTypes]);
    }

    public function removeUserTypes(Request $request){
        $params = $this->getParams($request);

        $userType = $this->em->getRepository(UserType::class)->find($params->id);

        $userType->setDeleted(true);

        $this->em->persist($userType);
        $this->em->flush();

        return $this->getSuccessResponse();
    }
}