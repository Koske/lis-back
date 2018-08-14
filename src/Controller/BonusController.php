<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 20.7.18.
 * Time: 11.26
 */

namespace App\Controller;


use App\API\HandlerType;
use Symfony\Component\HttpFoundation\Request;

class BonusController extends BaseController
{
    public function newBonusAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Bonus);

        return $handler->newBonus($request);
    }

    public function getBonusesAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Bonus);

        return $handler->getBonuses();
    }

    public function removeBonusAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Bonus);

        return $handler->removeBonus($request);
    }

    public function getBonusByIdAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Bonus);

        return $handler->getBonusById($request);
    }

    public function editBonusAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Bonus);

        return $handler->editBonus($request);
    }

    public function filterBonusesAction(Request $request) {

        $handler = $this->getHandler($request, HandlerType::Bonus);

        return $handler->filterBonuses($request);
    }
}