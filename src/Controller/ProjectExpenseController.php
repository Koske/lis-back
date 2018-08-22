<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 16.8.18.
 * Time: 11.28
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class ProjectExpenseController extends BaseController
{
    public function newProjectExpenseAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::ProjectExpense, null);


        return $handler->newProjectExpense($request);
    }

    public function getAllProjectExpensesAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::ProjectExpense, null);


        return $handler->getAllProjectExpenses($request);
    }

    public function removeProjectExpenseAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::ProjectExpense, null);


        return $handler->removeProjectExpense($request);
    }

    public function editProjectExpenseAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::ProjectExpense, null);


        return $handler->editProjectExpense($request);
    }

    public function getProjectExpenseByIdAction(Request $request)
    {
        $handler = $this->getHandler($request, HandlerType::ProjectExpense, null);


        return $handler->getProjectExpenseById($request);
    }
}