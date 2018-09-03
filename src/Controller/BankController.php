<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 20.8.18.
 * Time: 10.42
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class BankController extends BaseController
{
    public function newBankAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Bank);

        return $handler->newBank($request);
    }

    public function getAllBanksAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Bank);

        return $handler->getAllBanks($request);
    }

    public function removeBankAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Bank);

        return $handler->removeBank($request);
    }

    public function getExchangeRateAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Bank);

        return $handler->getExchangeRate($request);
    }
}