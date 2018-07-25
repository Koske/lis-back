<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 20.7.18.
 * Time: 16.18
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class DaysOffController extends BaseController
{
    public function newDaysOffAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::DaysOff);

        return $handler->newDaysOff($request);
    }

    public function getDaysOffAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::DaysOff);

        return $handler->getDaysOff();
    }

    public function removeDaysOffAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::DaysOff);

        return $handler->removeDaysOff($request);
    }

    public function editDaysOffAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::DaysOff);

        return $handler->editDaysOff($request);
    }

    public function getDayOffByIdAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::DaysOff);

        return $handler->getDayOffById($request);
    }
}