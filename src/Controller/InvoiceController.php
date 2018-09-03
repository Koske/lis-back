<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 24.8.18.
 * Time: 16.42
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class InvoiceController extends BaseController
{
    public function newInvoiceAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Invoice);

        return $handler->newInvoice($request);
    }

    public function getLastSerialNumberAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Invoice);

        return $handler->getLastSerialNumber($request);
    }
}