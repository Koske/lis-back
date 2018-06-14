<?php
/**
 * Created by PhpStorm.
 * User: milosa
 * Date: 4/26/2018
 * Time: 1:41 PM
 */

namespace App\API\V1;


use App\Entity\Presence;
use App\Entity\User;
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
        $presence->setDateCreated(new \DateTime());
        $presence->setYear($currentDate->format("Y"));
        $presence->setMonth($currentDate->format("m"));
        $presence->setClosed(false);

        if ($params->business) {
            $presence->setBusinessCheckOut(true);
        } else {
            $presence->setBusinessCheckOut(false);
        }

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
        $presence->setClosed(true);


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

}