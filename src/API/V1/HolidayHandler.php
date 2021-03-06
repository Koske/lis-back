<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 2.8.18.
 * Time: 16.00
 */

namespace App\API\V1;


use App\Entity\Holiday;
use App\Model\HolidayFilter;
use Symfony\Component\HttpFoundation\Request;

class HolidayHandler extends BaseHandler
{
    public function newHoliday(Request $request){
        $params = $this->getParams($request);

        $holiday = new Holiday();

        $holiday->setDateCreated(new \DateTime());
        $holiday->setDateUpdated(new \DateTime());
        $holiday->setDeleted(false);
        $holiday->setName($params->name);
        $holiday->setStartDate(new \DateTime($params->startDate));
        $holiday->setEndDate(new \DateTime($params->endDate));

        $this->em->persist($holiday);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getHolidays(){
        $holidays = $this->em->getRepository(Holiday::class)->findBy(['deleted'=> false]);

        return $this->getResponse(['holidays'=> $holidays]);
    }

    public function removeHoliday(Request $request){
        $params = $this->getParams($request);

        $holiday = $this->em->getRepository(Holiday::class)->find($params->id);

        $holiday->setDeleted(true);
        $holiday->setDateUpdated(new \DateTime());

        $this->em->persist($holiday);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function filterHolidays(Request $request){
        $elasticManager = $this->container->get('fos_elastica.manager');
        $params = $this->getParams($request);
        $holidayFilter = new HolidayFilter();


        $holidayFilter->setDeleted(false);
        $holidayFilter->setDateFrom($params->startDate);
        $holidayFilter->setDateTo($params->endDate);
        $holidayFilter->setType($params->dates);

        $holidays = $elasticManager->getRepository(Holiday::class)->search($holidayFilter);

        return $this->getResponse([
            'holidays' => $holidays['result'],
            'total' => $holidays['total']
        ]);
    }
}