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
use App\Entity\Company;
use Symfony\Component\HttpFoundation\Request;

class AccountHandler extends BaseHandler
{
    public function newAccount(Request $request){
        $params = $this->getParams($request);

        $bank = $this->em->getRepository(Bank::class)->find($params->bank);
        if($params->businessClient) {
            $businessClient = $this->em->getRepository(BusinessClient::class)->find($params->businessClient);
        }else {
            $company = $this->em->getRepository(Company::class)->find($params->company);
        }

        $account = new Account();

        $account->setType($params->type);
        $account->setAccountNumber($params->accountNumber);
        $account->setBank($bank);
        $account->setIban($params->iban);
        $account->setPib($params->pib);
        $account->setDeleted(false);
        if($params->businessClient) {
            $businessClient->setAccount($account);
        }else {
            $company->setAccount($account);
        }

        $this->em->persist($account);
        $this->em->flush();

        if($params->businessClient) {
            $this->em->persist($businessClient);
        }else{
            $this->em->persist($company);
        }
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getAccounts(){
        $accounts = $this->em->getRepository(Account::class)->findBy(['deleted'=> false]);

        return $this->getResponse(['accounts'=> $accounts]);
    }
}