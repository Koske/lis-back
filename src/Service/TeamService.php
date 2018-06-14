<?php
/**
 * Created by PhpStorm.
 * User: srdjan
 * Date: 28.3.18.
 * Time: 18.09
 */

namespace App\Service;

use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;

class TeamService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAll() {
        return $this->em->getRepository(Team::class)->findBy([ 'deleted' => false ]);
    }

}