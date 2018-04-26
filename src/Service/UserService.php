<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28.3.18.
 * Time: 17.21
 */

namespace App\Service;


use App\Entity\Position;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\UserType;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function createUser($firstName, $lastName, $email, $password, $userTypeId, $positionId, $teamId) {

        $user = new User();

        $userType = $this->em->getRepository(UserType::class)->find($userTypeId);

        $position = $this->em->getRepository(Position::class)->find($positionId);

        $team = $this->em->getRepository(Team::class)->find($teamId);

        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setUserType($userType);
        $user->setPosition($position);
        $user->setTeam($team);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setDeleted(false);
        $this->em->persist($user);
        $this->em->flush();

        return true;
    }
}