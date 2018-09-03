<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 27.8.18.
 * Time: 10.27
 */

namespace App\API\V1;


use App\Entity\Account;
use App\Entity\City;
use App\Entity\Company;
use App\Entity\Country;
use Symfony\Component\HttpFoundation\Request;

class CompanyHandler extends BaseHandler
{
    public function newCompany(Request $request){
        $params = $this->getParams($request);

        $country = $this->em->getRepository(Country::class)->find($params->country);

        $city = new City();

        $city->setCountry($country);
        $city->setName($params->city);
        $city->setZipCode($params->zip);

        $company = new Company();

        $company->setWeb($params->web);
        $company->setEmail($params->email);
        $company->setPhone($params->phoneNumber);
        $company->setFirmId($params->firmId);
        $company->setAddress($params->address);
        $company->setName($params->name);
        $company->setDeleted(false);
        $company->setDateCreated(new \DateTime());
        $company->setDateUpdated(new \DateTime());

        $company->setCity($city);

        $this->em->persist($city);
        $this->em->flush();

        $this->em->persist($company);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getCompanies(){
        $companies = $this->em->getRepository(Company::class)->findBy([
            'deleted'=> false
        ]);

        return $this->getResponse($companies);
    }

    public function getCompanyById(Request $request){
        $params = $this->getParams($request);

        $company = $this->em->getRepository(Company::class)->find($params->companyId);

        return $this->getResponse(['company'=> $company]);
    }

    public function getCountries(){
        $countries = $this->container->get('app.country')->getAll();

        return $this->getResponse($countries);
    }

    public function editCompany(Request $request){
        $params = $this->getParams($request);

        $company = $this->em->getRepository(Company::class)->find($params->id);
        $city = $company->getCity();
        $country = $this->em->getRepository(Country::class)->find($params->country);

        $city->setCountry($country);
        $city->setName($params->city);
        $city->setZipCode($params->zip);

        $company->setWeb($params->web);
        $company->setEmail($params->email);
        $company->setPhone($params->phoneNumber);
        $company->setFirmId($params->firmId);
        $company->setAddress($params->address);
        $company->setName($params->name);
        $company->setDeleted(false);
        $company->setDateUpdated(new \DateTime());

        $company->setCity($city);

        $this->em->persist($city);
        $this->em->flush();

        $this->em->persist($company);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function removeCompany(Request $request){
        $params = $this->getParams($request);

        $company = $this->em->getRepository(Company::class)->find($params->id);

        $company->setDeleted(true);

        $this->em->persist($company);
        $this->em->flush();

        return $this->getSuccessResponse();
    }
}