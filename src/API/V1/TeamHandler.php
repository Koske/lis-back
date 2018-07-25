<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 11.7.18.
 * Time: 12.15
 */

namespace App\API\V1;


use App\Entity\Team;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class TeamHandler extends BaseHandler
{
    public function newTeam(Request $request){
        $params = $this->getParams($request);

        $team = new Team();
        $team->setName($params->name);
        $team->setDescription($params->description);
        $team->setDateCreated(new \DateTime());
        $team->setDateUpdated(new \DateTime());
        $team->setDeleted(false);
        $this->em->persist($team);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getTeams(){
        $teams = $this->em->getRepository(Team::class)->findBy([
            'deleted' => false
        ]);

        return $this->getResponse([
            'teams' => $teams
        ]);
    }

    public function removeTeam(Request $request){
        $params = $this->getParams($request);

        $team = $this->em->getRepository(Team::class)->find($params->id);
        $team->setDeleted(true);

        $this->em->persist($team);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getTeamById(Request $request){
        $params = $this->getParams($request);

        $team = $this->em->getRepository(Team::class)->find($params->id);

        return $this->getResponse([
            'team' => $team
        ]);
    }

    public function editTeam(Request $request){
        $params = $this->getParams($request);

        $team = $this->em->getRepository(Team::class)->find($params->id);

        $team->setName($params->name);
        $team->setDescription($params->description);

        $this->em->persist($team);
        $this->em->flush();

        return $this->getSuccessResponse();

    }

    public function getUsersForTeam(Request $request){
        $params = $this->getParams($request);

        $team = $this->em->getRepository(Team::class)->find($params->id);
        $users = $this->em->getRepository(User::class)->findBy([
            'team' => $team
        ]);

        return $this->getResponse([
            'users' => $users
        ]);
    }

    public function removeFromTeam(Request $request){
        $params = $this->getParams($request);

        $user = $this->em->getRepository(User::class)->find($params->id);

        $user->setTeam(null);

        $this->em->persist($user);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

}