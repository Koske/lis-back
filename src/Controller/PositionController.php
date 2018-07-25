<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 24.7.18.
 * Time: 16.02
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class PositionController extends BaseController
{
    public function newPositionAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Position);

        return $handler->newPosition($request);
    }

    public function getPositionsAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Position);

        return $handler->getPositions();
    }

    public function removePositionAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Position);

        return $handler->removePosition($request);
    }
}