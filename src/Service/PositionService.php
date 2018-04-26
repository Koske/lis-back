<?php
/**
 * Created by PhpStorm.
 * User: srdjan
 * Date: 28.3.18.
 * Time: 17.49
 */

namespace App\Service;


use App\Entity\Position;
use Doctrine\ORM\EntityManagerInterface;

class PositionService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAll() {
        return $this->em->getRepository(Position::class)->findBy([ 'deleted' => false ]);
    }

}