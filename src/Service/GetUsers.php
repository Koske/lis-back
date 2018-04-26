<?php
/**
 * Created by PhpStorm.
 * User: srdjan
 * Date: 2.4.18.
 * Time: 10.12
 */

namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class GetUsers
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAll() {
        return $this->em->getRepository(User::class)->findBy([ 'deleted' => false ]);
    }

}