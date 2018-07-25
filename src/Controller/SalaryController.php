<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 18.7.18.
 * Time: 11.16
 */

namespace App\Controller;
use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;


class SalaryController extends BaseController
{
    public function newSalaryAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Salary);

        return $handler->newSalary($request);
    }

    public function getSalariesAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Salary);

        return $handler->getSalaries();
    }

    public function removeSalaryAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Salary);

        return $handler->removeSalary($request);
    }

    public function getSalaryByIdAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Salary);

        return $handler->getSalaryById($request);
    }

    public function editSalaryAction(Request $request){
        $handler = $this->getHandler($request, HandlerType::Salary);

        return $handler->editSalary($request);
    }
}