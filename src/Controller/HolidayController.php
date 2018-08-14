<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 2.8.18.
 * Time: 16.00
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class HolidayController extends BaseController
{
    public function newHolidayAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Holiday, null);


        return $handler->newHoliday($request);
    }

    public function getHolidaysAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Holiday, null);


        return $handler->getHolidays();
    }

    public function removeHolidayAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Holiday, null);


        return $handler->removeHoliday($request);
    }

    public function filterHolidaysAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Holiday, null);


        return $handler->filterHolidays($request);
    }
}