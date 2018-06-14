<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.2.18.
 * Time: 17.29
 */

namespace App\API\V1;

use App\API\V1\Interfaces\IUserHandler;
use App\Entity\Position;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\UserType;
use App\Model\UserFilter;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserHandler extends BaseHandler implements IUserHandler
{
    function __construct(EntityManagerInterface $em, ContainerInterface $container, LoggerInterface $logger)
    {
        parent::__construct($em, $container, $logger);
    }

    public function getCurrentUser()
    {
        return $this->getResponse([
            'status' => 'ok',
            'user' => $this->getUser()
        ], Response::HTTP_OK);
    }

    public function createUser($request)
    {

        if ($this->user == null) {
            //return $this->getResponse(['error' => 'not exist'], Response::HTTP_FORBIDDEN);
        }

        $params = $this->getParams($request);

        if (!$params->firstName ||
            !$params->lastName ||
            !$params->email ||
            !$params->password ||
            !$params->userTypeId ||
            !$params->positionId ||
            !$params->teamId)
        {
            return $this->getParameterMissingResponse();
        }

        $this->container->get('app.user')->createUser(
            $params->firstName,
            $params->lastName,
            $params->email,
            $params->password,
            $params->userTypeId,
            $params->positionId,
            $params->teamId);

        return $this->getSuccessResponse();
    }

    public function getUserData()
    {

        if ($this->user == null) {
            //return $this->getResponse(['error' => 'not exist'], Response::HTTP_FORBIDDEN);
        }

        return $this->getResponse([
            'user_types' => $this->container->get('app.user.type')->getAll(),
            'positions' => $this->container->get('app.position')->getAll(),
            'teams' => $this->container->get('app.team')->getAll()
        ]);
    }

    public function getUsers(Request $request)
    {


        $page = $request->get('page');
        $perPage = $request->get('perPage');
        $elasticManager = $this->container->get('fos_elastica.manager');

        $userFilter = new UserFilter();

        $userFilter->setPerPage($perPage);
        $userFilter->setPage($page);
        $userFilter->setDeleted(false);


        $users = $elasticManager->getRepository(User::class)->search($userFilter);
        $totalPages = floor($users['total'] / $perPage + 1);

        return $this->getResponse([
            'users' => $users['result'],
            'total' => $users['total'],
            'perPage' => $perPage,
            'page' => $page,
            'total_pages' => $totalPages
        ]);
    }


    public function getSearchUser(Request $request)
    {
        $page = $request->get('page');
        $perPage = $request->get('perPage');
        $search_term = $request->get('searchTerm');
        $elasticManager = $this->container->get('fos_elastica.manager');


        $userFilter = new UserFilter();

        $userFilter->setSearchTerm($search_term);
        $userFilter->setPerPage($perPage);
        $userFilter->setPage($page);
        $userFilter->setDeleted(false);


        $users = $elasticManager->getRepository(User::class)->search($userFilter);

        $totalPages = floor($users['total'] / $perPage + 1);


        return $this->getResponse([
            'users' => $users['result'],
            'total' => $users['total'],
            'searchTerm' => $search_term,
            'perPage' => $perPage,
            'page' => $page,
            'total_pages' => $totalPages
        ]);
    }

    public function getUserById(Request $request)
    {

        $params = $this->getParams($request);

        if (!$params->user_id) {
            return $this->getParameterMissingResponse();
        }

        $user = $this->em->getRepository(User::class)->find($params->user_id);

        return $this->getResponse([
            'status' => 'ok',
            'user' => $user
        ], Response::HTTP_OK);

    }

    public function getUpdateUser(Request $request)
    {
        $params = $this->getParams($request);

        if (!$params->email) {
            return $this->getParameterMissingResponse();
        }

        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $params->email]);

        $userType = $this->em->getRepository(UserType::class)->find($params->userTypeId);

        $position = $this->em->getRepository(Position::class)->find($params->positionId);

        $team = $this->em->getRepository(Team::class)->find($params->teamId);

        $user->setFirstName($params->firstName);
        $user->setLastName($params->lastName);
        $user->setUserType($userType);
        $user->setPosition($position);
        $user->setTeam($team);
        $user->setDeleted(false);

        $this->em->persist($user);
        $this->em->flush();

        return $this->getResponse(['status' => 'ok'], Response::HTTP_OK);

    }

//    public function getDeleteUser(Request $request)
//    {
//        $params = $this->getParams($request);
//
//        if (!$params->email) {
//            return $this->getParameterMissingResponse();
//        }
//
//        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $params->email]);
//
//        $user->setDeleted(true);
//
//        $this->em->flush();
//
//        return $this->getResponse(['status' => 'ok'], Response::HTTP_OK);
//    }

    public function getDeleteUser(Request $request)
    {
        $params = $this->getParams($request);

        if(!$params->id)
        {
            return $this->getParameterMissingResponse();
        }

        $user = $this->em->getRepository(User::class)->find($params->id);

        $user->setDeleted(true);
        $this->em->persist($user);
        $this->em->flush();

        return $this->getResponse(['status' => 'ok'], Response::HTTP_OK);
    }
}