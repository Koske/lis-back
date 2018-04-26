<?php
/**
 * Created by PhpStorm.
 * User: dusanka
 * Date: 21.2.18.
 * Time: 14.43
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UserController extends BaseController
{
    public function getCurrentUserAction(Request $request)
    {
        /*  Check if user is authenticated
            this will return 403 if user is not authenticated
        */
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $handler = $this->getHandler($request, HandlerType::User);
        $user = $handler->getCurrentUser();

        return $user;
    }

    public function getCreateUserDataAction(Request $request)
    {

        $handler = $this->getHandler($request, HandlerType::User);

        return $handler->getCreateUserData();
    }

    public function createUserAction(Request $request)
    {

        $handler = $this->getHandler($request, HandlerType::User);

        return $handler->createUser($request);
    }

    public function getUsersAction(Request $request)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $handler = $this->getHandler($request, HandlerType::User);

        return $handler->getUsers($request);
    }

    public function getSearchUserAction(Request $request)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $handler = $this->getHandler($request, HandlerType::User);

        return $handler->getSearchUser($request);
    }

    public function editUserAction(Request $request)
    {
        return new Response();
    }
}