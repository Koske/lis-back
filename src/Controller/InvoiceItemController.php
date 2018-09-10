<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 5.9.18.
 * Time: 16.47
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class InvoiceItemController extends BaseController
{
    public function getInvoiceItemAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::InvoiceItem);

        return $handler->getInvoiceItem($request);
    }
}