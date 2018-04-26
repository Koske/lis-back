<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28.3.18.
 * Time: 16.44
 */

namespace App\Service;

use App\Entity\UserType;
use Doctrine\ORM\EntityManagerInterface;

class UserTypeService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAll() {
        return $this->em->getRepository(UserType::class)->findBy([ 'deleted' => false ]);
    }
}