<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 27.8.18.
 * Time: 11.31
 */

namespace App\Service;


use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;

class CountryService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAll() {
        return $this->em->getRepository(Country::class)->findAll();
    }
}