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
use App\Entity\Currency;
use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Model\InvoiceFilter;
use Symfony\Component\HttpFoundation\Request;

class InvoiceHandler extends BaseHandler
{
    public function newInvoice(Request $request)
    {
        $params = $this->getParams($request);

        $sentItems = $params->invoice->items;

        $invoice = new Invoice();

        $invoice->setDateCreated(new \DateTime());
        $invoice->setDateUpdated(new \DateTime());
        $invoice->setDeleted(false);

        $businessClient = $this->em->getRepository(BusinessClient::class)->find($params->invoice->generalInfo->businessClient);
        $company = $this->em->getRepository(Company::class)->find($params->invoice->generalInfo->company);

        $invoiceDB = $this->em->getRepository(Invoice::class)->findBy(
            [
                'type' => $params->invoice->generalInfo->type,
                'company'=> $company,
                'year' => (new \DateTime())->format('Y'),
                'deleted'=> false
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
        $invoice->setType($params->invoice->generalInfo->type);
        $invoice->setSerialNumber($serial);
        $invoice->setYear((new \DateTime())->format('Y'));
        if(isset($params->invoice->pinfo->paymentMethod) && isset($params->invoice->pinfo->paymentMethod)) {
            $invoice->setPaymentMethod($params->invoice->pinfo->paymentMethod);
            $invoice->setPaymentDeadline($params->invoice->pinfo->paymentDeadline);
        }else {
            $invoice->setPaymentMethod('');
            $invoice->setPaymentDeadline('');
        }
        if(isset($params->invoice->pinfo->currency)){
            $currency = $this->em->getRepository(Currency::class)->find($params->invoice->pinfo->currency->id);
            $invoice->setCurrency($currency);
        }

        $this->em->persist($invoice);
        $this->em->flush();

        foreach ($sentItems as $s) {
            $invoiceItem = new InvoiceItem();

            $invoiceItem->setDateCreated(new \DateTime());
            $invoiceItem->setDateUpdated(new \DateTime());
            $invoiceItem->setName($s->name);
            $invoiceItem->setAmount($s->amount);
            $invoiceItem->setUnitPrice($s->priceNoPDV);
            $invoiceItem->setUnit($s->unit);
            $invoiceItem->setInvoice($invoice);

            $this->em->persist($invoiceItem);
            $this->em->flush();
        }

        return $this->getSuccessResponse();

    }

    public function getLastSerialNumber(Request $request){
        $params = $this->getParams($request);

        $company = $this->em->getRepository(Company::class)->find($params->invoice->generalInfo->company);

        $invoiceDB = $this->em->getRepository(Invoice::class)->findBy(
            [
                'type' => $params->invoice->generalInfo->type,
                'company'=> $company,
                'year' => (new \DateTime())->format('Y'),
                'deleted'=> false
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

    public function getInvoices(){
        $invoices = $this->em->getRepository(Invoice::class)->findBy(['deleted'=> false]);

        return $this->getResponse($invoices);
    }

    public function getInvoiceById(Request $request){
        $params = $this->getParams($request);

        $invoice = $this->em->getRepository(Invoice::class)->find($params->id);

        return $this->getResponse([$invoice]);
    }

    public function filterInvoices(Request $request){
        $elasticManager = $this->container->get('fos_elastica.manager');
        $params = $this->getParams($request);
        $invoiceFilter = new InvoiceFilter();
        if($params->company!= null) {
            $company = $this->em->getRepository(Company::class)->find($params->company);
            $invoiceFilter->setCompany($company);
        }

        if($params->businessClient!=null) {
            $businessClient = $this->em->getRepository(BusinessClient::class)->find($params->businessClient);
            $invoiceFilter->setBusinessClient($businessClient);
        }
        $invoiceFilter->setDeleted(false);
        $invoiceFilter->setDateFrom($params->startDate);
        $invoiceFilter->setDateTo($params->endDate);
        if($params->type!= null)
            $invoiceFilter->setType($params->type);

        $invoices = $elasticManager->getRepository(Invoice::class)->search($invoiceFilter);

        return $this->getResponse([
            'invoices' => $invoices['result'],
            'total' => $invoices['total']
        ]);
    }

    public function removeInvoice(Request $request){
        $params = $this->getParams($request);

        $invoice = $this->em->getRepository(Invoice::class)->find($params->id);
        $invoice->setDeleted(true);
        $this->em->persist($invoice);
        $this->em->flush();

        return $this->getSuccessResponse();


    }


}