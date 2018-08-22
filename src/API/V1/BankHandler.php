<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 20.8.18.
 * Time: 10.41
 */

namespace App\API\V1;


use App\Entity\Bank;
use Symfony\Component\HttpFoundation\Request;

class BankHandler extends BaseHandler
{
    public function newBank(Request $request){
        $params = $this->getParams($request);

        $bank = new Bank();

        $bank->setName($params->name);
        $bank->setSwift($params->swift);
        $bank->setDeleted(false);

        $this->em->persist($bank);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getAllBanks(){
        $banks = $this->em->getRepository(Bank::class)->findBy(['deleted'=> false]);

        return $this->getResponse(['banks'=> $banks]);
    }

    public function removeBank(Request $request){
        $params = $this->getParams($request);

        $bank = $this->em->getRepository(Bank::class)->find($params->id);
        $bank->setDeleted(true);

        $this->em->persist($bank);
        $this->em->flush();

        return $this->getSuccessResponse();
    }
}