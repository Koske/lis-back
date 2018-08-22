<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 16.8.18.
 * Time: 14.37
 */

namespace App\API\V1;


use App\Entity\Currency;

class CurrencyHandler extends BaseHandler
{
    public function getCurrency(){
        $currencies = $this->em->getRepository(Currency::class)->findAll();

        return $this->getResponse(['currencies'=> $currencies]);
    }
}