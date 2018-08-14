<?php
/**
 * Created by PhpStorm.
 * User: milosa
 * Date: 4/26/2018
 * Time: 1:41 PM
 */

namespace App\API\V1;


use App\Entity\Presence;
use App\Entity\PresenceEdited;
use App\Entity\User;
use App\Model\PresenceEditedFilter;
use App\Model\PresenceFilter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PresenceHandler extends BaseHandler
{

    public function checkIn(Request $request)
    {
        $params = $this->getParams($request);

        if (!$params->email) {
            return $this->getParameterMissingResponse();
        }

//        if ($this->user == null) {
//            return $this->getResponse(['error' => 'not exist'], Response::HTTP_FORBIDDEN);
//        }

        //$user = $this->em->getRepository(User::class)->findOneBy(['email' => $this->user]);
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $params->email]);
        $presences = $this->em->getRepository(Presence::class)->findBy(['user' => $user]);

        foreach ($presences as &$p) {
            if ($p->getEnd() === null) {
                return $this->getResponse(['status' => 'error', 'message' => 'You must checkout first'], Response::HTTP_OK);
            }
        }
        $currentDate = new \DateTime();

        $presence = new Presence();

        $presence->setUser($user);
        $presence->setStart(new \DateTime());
        $presence->setEightHours(false);
        $presence->setDateCreated(new \DateTime());
        $presence->setYear($currentDate->format("Y"));
        $presence->setMonth($currentDate->format("m"));
        $presence->setClosed(false);
        $presence->setAutoClosed(false);



        $this->em->persist($presence);
        $this->em->flush();

        return $this->getResponse(['status' => 'ok'], Response::HTTP_OK);
    }

    public function checkOut(Request $request)
    {

//        if ($this->user == null) {
//            return $this->getResponse(['error' => 'not exist'], Response::HTTP_FORBIDDEN);
//        }

        $params = $this->getParams($request);

        if (!$params->email) {
            return $this->getParameterMissingResponse();
        }

        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $params->email]);
        $presence = $this->em->getRepository(Presence::class)->findOneBy(['user' => $user, 'end' => null]);


        $presence->setEnd(new \DateTime());
        $presence->setDateUpdated(new \DateTime());
        $start = $presence->getStart()->format('H:i:s');
        $end = $presence->getEnd()->format('H:i:s');

        $hourmiliStart = (int)substr($start, 0, 2) * 3600000;
        $minutemiliStart = (int)substr($start, 3, 2) * 60000;
        $secondmiliStart = (int)substr($start, 6, 2) * 1000;

        $hourmiliEnd = (int)substr($end, 0, 2) * 3600000;
        $minutemiliEnd = (int)substr($end, 3, 2) * 60000;
        $secondmiliEnd = (int)substr($end, 6, 2) * 1000;

        $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
        $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

        if($this->isLessEightHours($start, $end)){
            $presence->setEightHours(false);
        }else{
            $presence->setEightHours(true);
        }

        $presence->setClosed(true);
        if ($params->business) {
            $presence->setBusinessCheckOut(true);
        } else {
            $presence->setBusinessCheckOut(false);
        }

        $this->em->persist($presence);
        $this->em->flush();

        return $this->getResponse(['status' => 'ok'], Response::HTTP_OK);

    }

    public function userIsCheckedIn(Request $request) {
        $params = $this->getParams($request);

        if (!$params->email) {
            return $this->getParameterMissingResponse();
        }

        //$user = $this->em->getRepository(User::class)->findOneBy(['email' => $this->user]);
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $params->email]);
        $presences = $this->em->getRepository(Presence::class)->findBy(['user' => $user]);

        foreach ($presences as &$p)
        {
            if ($p->getEnd() === null) {
                return $this->getResponse(['status' => 'ok', 'checkedIn' => true], Response::HTTP_OK);
            }
        }
        return $this->getResponse(['status' => 'ok', 'checkedIn' => false], Response::HTTP_OK);
    }

    public function getPresenceByUser(Request $request){
        $params = $this->getParams($request);

        $presences = $this->em->getRepository(Presence::class)->findBy([
            'user' => $params->user->id
        ]);

        return $this->getResponse([
            'presences' => $presences
        ]);

    }

    public function editPresence(Request $request)
    {
        $params = $this->getParams($request);
        $time = $params->time;
        $presenceId = $params->presence;
        $type = $params->type;

        $presenceRep = $this->em->getRepository(Presence::class)->find($presenceId);
        //  $user = $this->em->getRepository(User::class)->find($presenceRep->getUser());
        $user = $presenceRep->getUser();
        $checkPresence = $this->em->getRepository(PresenceEdited::class)->findBy([
            'user' => $user,
            'presence' => $presenceRep
        ]);
        if ($checkPresence){
            if ($type == 'start') {
                $presenceRep->setStart(new \DateTime($presenceRep->getStart()->format('Y-m-d') . ' ' . $time));
                $checkPresence[0]->setDateUpdated(new \DateTime());
                $checkPresence[0]->setStart($presenceRep->getStart());
            } elseif ($type == 'end') {
                $presenceRep->setEnd(new \DateTime($presenceRep->getEnd()->format('Y-m-d') . ' ' . $time));
                $checkPresence[0]->setDateUpdated(new \DateTime());
                $checkPresence[0]->setEnd($presenceRep->getEnd());
            }
            $this->em->persist($checkPresence[0]);
    }else {

            $presenceEdited = new PresenceEdited();
            $presenceEdited->setDateUpdated(new \DateTime());
            $presenceEdited->setDateCreated(new \DateTime());
            $presenceEdited->setDeleted(false);
            $presenceEdited->setOriginalStart($presenceRep->getStart());
            $presenceEdited->setOriginalEnd($presenceRep->getEnd());
            $presenceEdited->setPresence($presenceRep);
            $presenceEdited->setUser($user);

            if($type == 'start'){
                $presenceRep->setStart(new \DateTime($presenceRep->getStart()->format('Y-m-d'). ' '.$time));
                $presenceEdited->setDateUpdated(new \DateTime());
                $presenceEdited->setStart($presenceRep->getStart());
            }elseif ($type == 'end'){
                $presenceRep->setEnd(new \DateTime($presenceRep->getEnd()->format('Y-m-d') .' '.$time));
                $presenceEdited->setDateUpdated(new \DateTime());
                $presenceEdited->setEnd($presenceRep->getEnd());
            }

            $this->em->persist($presenceEdited);
        }


        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getEditedPresences(Request $request){
        $params = $this->getParams($request);
        $user = $this->em->getRepository(User::class)->find($params->userId);
        $presences = $this->em->getRepository(PresenceEdited::class)->findBy([
            'user' => $user
        ]);

        return $this->getResponse([
            'presences' => $presences,
            'user' => $user
        ]);
    }

    function isLessEightHours($start, $end){
        if($end-$start<28800000){
            return true;
        }else {
            return false;
        }
    }


    public function filterEditedPresences(Request $request){
        $elasticManager = $this->container->get('fos_elastica.manager');
        $params = $this->getParams($request);
        $presenceEditedFilter = new PresenceEditedFilter();

        if($params->id != null) {
            $user = $this->em->getRepository(User::class)->find($params->id);
            $presenceEditedFilter->setUser($user);
        }

        $presenceEditedFilter->setDeleted(false);
        $presenceEditedFilter->setDateFrom($params->startDate);
        $presenceEditedFilter->setDateTo($params->endDate);
        $presenceEditedFilter->setType($params->dates);

        $presenceEdited = $elasticManager->getRepository(PresenceEdited::class)->search($presenceEditedFilter);

        return $this->getResponse([
            'presences' => $presenceEdited['result'],
            'total' => $presenceEdited['total']
        ]);
    }

    public function filterPresences(Request $request){
        $elasticManager = $this->container->get('fos_elastica.manager');
        $params = $this->getParams($request);
        $presenceFilter = new PresenceFilter();

        $user = $this->em->getRepository(User::class)->find($params->id);
        $presenceFilter->setUser($user);
        $presenceFilter->setDeleted(false);
        $presenceFilter->setDateFrom($params->startDate);
        $presenceFilter->setDateTo($params->endDate);
        $presenceFilter->setType($params->dates);

        $presences = $elasticManager->getRepository(Presence::class)->search($presenceFilter);

        return $this->getResponse([
            'presences' => $presences['result'],
            'total' => $presences['total']
        ]);
    }


}