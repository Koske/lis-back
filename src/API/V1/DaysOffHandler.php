<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 20.7.18.
 * Time: 16.18
 */

namespace App\API\V1;


use App\Entity\DayOff;
use App\Entity\DaysOffStats;
use App\Entity\Holiday;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class DaysOffHandler extends BaseHandler
{
    public function newDaysOff(Request $request){
        $params = $this->getParams($request);

        $daysOff = new DayOff();

        $user= $this->em->getRepository(User::class)->find($params->userId);
        $start = new \DateTime($params->start);
        $end = new \DateTime($params->end);
        $daysOff->setStart($start);
        $daysOff->setEnd($end);
        $workdays = $this->getWorkdays($daysOff->getStart()->format('Y-m-d'), $daysOff->getEnd()->format('Y-m-d'));
        $daysOff->setWorkdays($workdays);
        $daysOff->setStatus('Pending');
        $daysOff->setDeleted(false);
        $daysOff->setUser($user);
        $daysOff->setDateCreated(new \DateTime());
        $daysOff->setDateUpdated(new \DateTime());

        $this->em->persist($daysOff);
        $this->em->flush();


        return $this->getSuccessResponse();

    }

    public function getDaysOff(){
        $daysOff = $this->em->getRepository(DayOff::class)->findBy([
            'deleted'=> false
        ]);

        return $this->getResponse([
            'daysOff'=> $daysOff
        ]);
    }

    public function getDaysOffUser(Request $request){
        $params = $this->getParams($request);

        $user = $this->em->getRepository(User::class)->find($params->id);
        $dayOff = $this->em->getRepository(DayOff::class)->findBy([
            'user'=> $user,
            'deleted'=> false
        ]);

        return $this->getResponse(['dayOff'=> $dayOff]);
    }

    public function removeDaysOff(Request $request){
        $params = $this->getParams($request);

        $daysOff = $this->em->getRepository(DayOff::class)->find($params->id);
        $user = $daysOff->getUser();
        $daysOff->setDeleted(true);

        if($daysOff->getStatus() == 'Approved'){
            $yearStart = $daysOff->getStart()->format('Y');
            $yearEnd = $daysOff->getEnd()->format('Y');

            if($yearStart == $yearEnd){
                $daysOffStats = $this->em->getRepository(DaysOffStats::class)->findBy([
                    'user'=> $user,
                    'year'=> $yearStart
                ]);
                $daysOffStats[0]->setDaysOff($daysOffStats[0]->getDaysOff()- $daysOff->getWorkdays());
                $this->em->persist($daysOffStats[0]);
            }else{
                $daysOffStatsStart = $this->em->getRepository(DaysOffStats::class)->findBy([
                    'user'=> $user,
                    'year'=> $yearStart
                ]);
                $daysOffStatsEnd = $this->em->getRepository(DaysOffStats::class)->findBy([
                    'user'=> $user,
                    'year'=> $yearEnd
                ]);
                $yearOne = new \DateTime($yearStart. '-12-31');
                $yearTwo= new \DateTime($yearEnd. '-01-01');

                $workdaysCounterFirst = $this->getWorkdays($daysOff->getStart()->format('Y-m-d'), $yearOne->format('Y-m-d'));
                $workdaysCounterSecond = $this->getWorkdays($yearTwo->format('Y-m-d'), $daysOff->getEnd()->format('Y-m-d'));

                $daysOffStatsStart[0]->setDaysOff($daysOffStatsStart[0]->getDaysOff()- $workdaysCounterFirst);
                $daysOffStatsEnd[0]->setDaysOff($daysOffStatsEnd[0]->getDaysOff()- $workdaysCounterSecond);

                $this->em->persist($daysOffStatsStart[0]);
                $this->em->persist($daysOffStatsEnd[0]);
            }
        }

        $this->em->persist($daysOff);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function editDaysOff(Request $request){
        $params = $this->getParams($request);
        $dayOff = $this->em->getRepository(DayOff::class)->find($params->daysOff->daysOffId);

        $dayOff->setStart(new \DateTime($params->daysOff->start));
        $dayOff->setEnd(new \DateTime($params->daysOff->end));

        $this->em->persist($dayOff);
        $this->em->flush();

        return $this->getSuccessResponse();

    }

    public function getDayOffById(Request $request){
        $params = $this->getParams($request);

        $dayOff = $this->em->getRepository(DayOff::class)->find($params->id);

        return $this->getResponse([
            'dayOff'=> $dayOff
        ]);
    }

    public function decisionDaysOff(Request $request){
        $params = $this->getParams($request);
        $daysOff = $this->em->getRepository(DayOff::class)->find($params->dayOffId);
        $daysOff->setStatus($params->status);
        $daysOff->setReasonDeclined($params->reasonDeclined);
        $daysOff->setDateUpdated(new \DateTime());
        $start = $daysOff->getStart();
        $end = $daysOff->getEnd();
        $user = $daysOff->getUser();
        if($params->status == 'Approved'){

            $yearStart = $start->format('Y');
            $yearEnd = $end->format('Y');

            if($yearStart == $yearEnd){
                $workdaysCounter = $this->getWorkdays($start->format('Y-m-d'), $end->format('Y-m-d'));

                $checkOne = $this->em->getRepository(DaysOffStats::class)->findBy([
                    'user' => $user,
                    'year' => $yearStart
                ]);
                if($checkOne== null) {
                    $daysOffStats = new DaysOffStats();
                    $daysOffStats->setUser($user);
                    $daysOffStats->setYear($yearEnd);
                    $daysOffStats->setDaysOff($workdaysCounter);
                    $this->em->persist($daysOffStats);
                }else{
                    $days = $checkOne[0]->getDaysOff();
                    $days += $workdaysCounter;
                    $checkOne[0]->setDaysOff($days);

                    $this->em->persist($checkOne[0]);
                }

            }else{
                $checkOne = $this->em->getRepository(DaysOffStats::class)->findBy([
                    'user' => $user,
                    'year' => $yearStart
                ]);
                $checkTwo = $this->em->getRepository(DaysOffStats::class)->findBy([
                    'user' => $user,
                    'year' => $yearEnd
                ]);
                $yearOne = new \DateTime($yearStart. '-12-31');
                $yearTwo= new \DateTime($yearEnd. '-01-01');

                $workdaysCounterFirst = $this->getWorkdays($start->format('Y-m-d'), $yearOne->format('Y-m-d'));
                $workdaysCounterSecond = $this->getWorkdays($yearTwo->format('Y-m-d'), $end->format('Y-m-d'));

                if($checkOne == null){
                    $statsOne = new DaysOffStats();
                    $statsOne->setUser($user);
                    $statsOne->setYear($yearStart);
                    $statsOne->setDaysOff($workdaysCounterFirst);
                    $this->em->persist($statsOne);
                }else{
                    $days = $checkOne[0]->getDaysOff();
                    $days += $workdaysCounterFirst;
                    $checkOne[0]->setDaysOff($days);

                    $this->em->persist($checkOne[0]);
                }

                if($checkTwo == null){
                    $statsTwo = new DaysOffStats();
                    $statsTwo->setUser($user);
                    $statsTwo->setYear($yearEnd);
                    $statsTwo->setDaysOff($workdaysCounterSecond);
                    $this->em->persist($statsTwo);
                }else{
                    $days = $checkTwo[0]->getDaysOff();
                    $days += $workdaysCounterSecond;
                    $checkTwo[0]->setDaysOff($days);

                    $this->em->persist($checkTwo[0]);
                }

            }
        }




        if($params->reasonDeclined != null)
            $daysOff->setReasonDeclined($params->reasonDeclined);

        $this->em->persist($daysOff);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getWorkdays($date1, $date2) {
        if (!defined('SATURDAY')) define('SATURDAY', 6);
        if (!defined('SUNDAY')) define('SUNDAY', 0);
        // Array of all public festivities
        $holidaysDB = $this->em->getRepository(Holiday::class)->findBy(['deleted'=> false]);


        $holidays = [];
        $dates = [];
        foreach($holidaysDB as $h){
            $start = new \DateTime($h->getStartDate()->format('Y-m-d'));
            $end = new \DateTime($h->getEndDate()->format('Y-m-d'));
            var_dump($start);
            var_dump($end);
            while($start <= $end){
                array_push($dates, new \DateTime($start->format('Y-m-d')));
                $start->modify('+1 day');
            }
        }
        foreach($dates as $h){
            array_push($holidays, $h->format('m-d'));
        }
        $publicHolidays = $holidays;


        $start = strtotime($date1);
        $end   = strtotime($date2);
        $workdays = 0;
        for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
            $day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
            $mmgg = date('m-d', $i);
            if ($day != SUNDAY &&
                !in_array($mmgg, $publicHolidays) &&
                $day != SATURDAY) {
                $workdays++;
            }
        }
        return intval($workdays);
    }

    public function getDaysOffStats(){
        $currentYear = (new \DateTime())->format('Y');

        $daysOffStats = $this->em->getRepository(DaysOffStats::class)->findBy([
            'year'=> $currentYear
        ]);

        return $this->getResponse(['daysOffStats'=> $daysOffStats]);
    }

    public function getDaysOffStatsByUser(Request $request){
        $params = $this->getParams($request);

        $user = $this->em->getRepository(User::class)->find($params->id);
        $daysOffStats = $this->em->getRepository(DaysOffStats::class)->findBy([
            'user'=> $user
        ]);

        return $this->getResponse(['daysOffStats'=> $daysOffStats]);
    }
}