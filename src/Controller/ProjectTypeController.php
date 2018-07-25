<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 24.7.18.
 * Time: 10.52
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class ProjectTypeController extends BaseController
{
    public function newProjectTypeAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::ProjectType);

        return $handler->newProjectType($request);
    }

    public function getProjectTypesAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::ProjectType);

        return $handler->getProjectTypes();
    }

    public function removeProjectTypeAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::ProjectType);

        return $handler->removeProjectType($request);
    }
}