<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 20.8.18.
 * Time: 12.29
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends BaseController
{
    public function newAccountAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Account);

        return $handler->newAccount($request);
    }

    public function getAccountsAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Account);

        return $handler->getAccounts($request);
    }
}