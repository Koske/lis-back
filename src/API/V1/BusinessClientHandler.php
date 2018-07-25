<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 18.7.18.
 * Time: 16.55
 */

namespace App\API\V1;


use App\Entity\Account;
use App\Entity\BusinessClient;
use App\Entity\City;
use App\Entity\Country;
use Symfony\Component\HttpFoundation\Request;

class BusinessClientHandler extends BaseHandler
{
    public function newBusinessClient(Request $request){
        $params = $this->getParams($request);

        $exists = $this->em->getRepository(BusinessClient::class)->findBy([
            'phone_number' => $params->phoneNumber
        ]);
        if(!$exists) {
            $country = $this->em->getRepository(Country::class)->find($params->country);

            $city = new City();
            $city->setName($params->city);
            $city->setCountry($country);
            $city->setZipCode($params->zip);

            $account = new Account();
            $account->setAccountNumber($params->accountNumber);
            $account->setBank($params->bank);

            $businessClient = new BusinessClient();
            $businessClient->setAccount($account);
            $businessClient->setName($params->name);
            $businessClient->setCity($city);
            $businessClient->setAddress($params->address);
            $businessClient->setPhoneNumber($params->phoneNumber);


            $this->em->persist($city);
            $this->em->flush();

            $this->em->persist($account);
            $this->em->flush();

            $this->em->persist($businessClient);
            $this->em->flush();



            return $this->getSuccessResponse();
        }

        return $this->getResponse([
            'Exists'
        ]);
    }

    public function getBusinessClients(){
        $businessClients = $this->em->getRepository(BusinessClient::class)->findAll();

        return $this->getResponse([
            'businessClients'=> $businessClients
        ]);
    }

    public function getBusinessClientById(Request $request){
        $params = $this->getParams($request);

        $businessClient = $this->em->getRepository(BusinessClient::class)->find($params->id);

        return $this->getResponse([
            'businessClient'=> $businessClient
        ]);
    }

    public function editBusinessClient(Request $request){
        $params = $this->getParams($request);

        $businessClient = $this->em->getRepository(BusinessClient::class)->find($params->businessClientId);

        $country = $this->em->getRepository(Country::class)->find($params->countryId);

        $city = $businessClient->getCity();
        $city->setCountry($country);
        $city->setName($params->city);
        $city->setZipCode($params->zip);

        $account = $businessClient->getAccount();
        $account->setAccountNumber($params->accountNumber);
        $account->setBank($params->bank);

        $businessClient->setCity($city);
        $businessClient->setAccount($account);
        $businessClient->setName($params->name);
        $businessClient->setAddress($params->address);
        $businessClient->setPhoneNumber($params->phoneNumber);

        $this->em->persist($city);
        $this->em->flush();

        $this->em->persist($account);
        $this->em->flush();

        $this->em->persist($businessClient);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getCountries(){
        $countries = $this->em->getRepository(Country::class)->findAll();

        return $this->getResponse([
            'countries'=> $countries
        ]);
    }
}