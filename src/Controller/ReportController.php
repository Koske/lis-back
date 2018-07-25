<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 11.6.18.
 * Time: 12.54
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class ReportController extends BaseController
{
    public function getInitialInfoAction(Request $request)
    {

        $handler = $this->getHandler($request, HandlerType::Report);

        return $handler->getInitialInfo($request);
    }

    public function getInfoForMonthAction(Request $request)
    {

        $handler = $this->getHandler($request, HandlerType::Report);

        return $handler->getInfoForMonth($request);
    }
}