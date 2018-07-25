<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 11.7.18.
 * Time: 12.12
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends BaseController
{
    public function newTeamAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Team, null);


        return $handler->newTeam($request);
    }
    public function getTeamsAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Team, null);


        return $handler->getTeams();
    }
    public function removeTeamAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Team, null);


        return $handler->removeTeam($request);
    }
    public function getTeamByIdAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Team, null);


        return $handler->getTeamById($request);
    }
    public function editTeamAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Team, null);


        return $handler->editTeam($request);
    }
    public function getUsersForTeamAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Team, null);


        return $handler->getUsersForTeam($request);
    }
    public function removeFromTeamAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::Team, null);


        return $handler->removeFromTeam($request);
    }
}