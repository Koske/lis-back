<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 20.8.18.
 * Time: 12.29
 */

namespace App\API\V1;


use App\Entity\Account;
use App\Entity\Bank;
use App\Entity\BusinessClient;
use Symfony\Component\HttpFoundation\Request;

class AccountHandler extends BaseHandler
{
    public function newAccount(Request $request){
        $params = $this->getParams($request);

        $bank = $this->em->getRepository(Bank::class)->find($params->bank);
        $businessClient = $this->em->getRepository(BusinessClient::class)->find($params->businessClient);
        $account = new Account();

        $account->setType($params->type);
        $account->setAccountNumber($params->accountNumber);
        $account->setBank($bank);
        $account->setDeleted(false);
        $businessClient->setAccount($account);

        $this->em->persist($account);
        $this->em->flush();

        $this->em->persist($businessClient);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getAccounts(){
        $accounts = $this->em->getRepository(Account::class)->findBy(['deleted'=> false]);

        return $this->getResponse(['accounts'=> $accounts]);
    }
}