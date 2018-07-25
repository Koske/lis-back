<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 18.7.18.
 * Time: 16.56
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class BusinessClientController extends BaseController
{
    public function newBusinessClientAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::BusinessClient);

        return $handler->newBusinessClient($request);
    }

    public function getBusinessClientsAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::BusinessClient);

        return $handler->getBusinessClients($request);
    }

    public function getBusinessClientByIdAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::BusinessClient);

        return $handler->getBusinessClientById($request);
    }

    public function editBusinessClientAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::BusinessClient);

        return $handler->editBusinessClient($request);
    }

    public function getCountriesAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::BusinessClient);

        return $handler->getCountries($request);
    }
}