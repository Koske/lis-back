<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 16.8.18.
 * Time: 14.38
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class CurrencyController extends BaseController
{

    public function getCurrencyAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Currency, null);


        return $handler->getCurrency();
    }
}