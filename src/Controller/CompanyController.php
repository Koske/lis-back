<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 27.8.18.
 * Time: 10.28
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class CompanyController extends BaseController
{
    public function newCompanyAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Company);

        return $handler->newCompany($request);
    }

    public function getCompaniesAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Company);

        return $handler->getCompanies($request);
    }

    public function getCompanyByIdAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Company);

        return $handler->getCompanyById($request);
    }

    public function editCompanyAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Company);

        return $handler->editCompany($request);
    }

    public function removeCompanyAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Company);

        return $handler->removeCompany($request);
    }

    public function getCountriesAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Company);

        return $handler->getCountries($request);
    }

}