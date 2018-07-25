<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 24.7.18.
 * Time: 13.58
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class UserTypeController extends BaseController
{
    public function newUserTypeAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::UserType);

        return $handler->newUserType($request);
    }

    public function getUserTypesAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::UserType);

        return $handler->getUserTypes();
    }

    public function removeUserTypesAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::UserType);

        return $handler->removeUserTypes($request);
    }
}