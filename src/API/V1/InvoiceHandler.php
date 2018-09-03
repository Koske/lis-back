<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 24.8.18.
 * Time: 16.41
 */

namespace App\API\V1;


use App\Entity\BusinessClient;
use App\Entity\Company;
use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use Symfony\Component\HttpFoundation\Request;

class InvoiceHandler extends BaseHandler
{
    public function newInvoice(Request $request)
    {
        $params = $this->getParams($request);

        $sentInvoices = $params->invoice;
        $length = count($params->invoice);
        $invoice = new Invoice();

        $invoice->setDateCreated(new \DateTime());
        $invoice->setDateUpdated(new \DateTime());

        $businessClient = $this->em->getRepository(BusinessClient::class)->find($params->invoice[$length-1]->businessClient);
        $company = $this->em->getRepository(Company::class)->find($params->invoice[$length-1]->company);

        $invoiceDB = $this->em->getRepository(Invoice::class)->findBy(
            [
                'type' => $params->invoice[$length-1]->type,
                'company'=> $company,
                'year' => (new \DateTime())->format('Y')
            ],
            ['serialNumber' => 'DESC']
        );
        if ($invoiceDB){
            $serial = $invoiceDB[0]->getSerialNumber();
            $serial+= 1;
        }else{
            $serial = 1;
        }


        $invoice->setBusinessClient($businessClient);
        $invoice->setCompany($company);
        $invoice->setType($params->invoice[$length-1]->type);
        $invoice->setSerialNumber($serial);
        $invoice->setYear((new \DateTime())->format('Y'));
        $invoice->setPaymentMethod($params->invoice[$length-1]->paymentMethod);
        $invoice->setPaymentDeadline($params->invoice[$length-1]->paymentDeadline);


        $this->em->persist($invoice);
        $this->em->flush();

        foreach ($sentInvoices as $s) {
            $invoiceItem = new InvoiceItem();

            $invoiceItem->setDateCreated(new \DateTime());
            $invoiceItem->setDateUpdated(new \DateTime());
            $invoiceItem->setName($s->name);
            $invoiceItem->setAmount($s->amount);
            $invoiceItem->setPriceNoPDV($s->priceNoPDV);
            $invoiceItem->setUnit($s->unit);
            $invoiceItem->setInvoice($invoice);

            $this->em->persist($invoiceItem);
            $this->em->flush();
        }

        return $this->getSuccessResponse();

    }

    public function getLastSerialNumber(Request $request){
        $params = $this->getParams($request);
        $length = count($params->invoice);

        $company = $this->em->getRepository(Company::class)->find($params->invoice[$length-1]->company);

        $invoiceDB = $this->em->getRepository(Invoice::class)->findBy(
            [
                'type' => $params->invoice[$length-1]->type,
                'company'=> $company,
                'year' => (new \DateTime())->format('Y')
            ],
            ['serialNumber' => 'DESC']
        );
        if ($invoiceDB){
            $serial = $invoiceDB[0]->getSerialNumber();
        }else{
            $serial = 1;
        }

        return $this->getResponse([$serial]);
    }

}