<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 5.9.18.
 * Time: 16.47
 */

namespace App\API\V1;


use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use Symfony\Component\HttpFoundation\Request;

class InvoiceItemHandler extends BaseHandler
{
    public function getInvoiceItem(Request $request){
        $params = $this->getParams($request);

        $invoice = $this->em->getRepository(Invoice::class)->find($params->id);

        $item = $this->em->getRepository(InvoiceItem::class)->findBy([
            'invoice'=> $invoice
        ]);

        return $this->getResponse($item);
    }
}