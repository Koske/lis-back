<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 10.5.18.
 * Time: 16.36
 */

namespace App\API\V1;


use App\Entity\Etape;
use App\Entity\Participant;
use App\Entity\ParticipantType;
use App\Entity\Project;
use App\Entity\Task;
use App\Entity\User;
use App\Model\ParticipantFilter;
use App\Model\ProjectFilter;
use App\Model\UserFilter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ParticipantHandler extends BaseHandler
{
    public function getParticipants(Request $request){
        $params = $this->getParams($request);

        $project_id = $params->project_id;
        $project = $this->em->getRepository(Project::class)->find($project_id);
        $participant = $this->em->getRepository(Participant::class)->findBy(array(
            'project'=>$project,
            'deleted'=> false));





        return $this->getResponse([
            'part' => $participant
        ]);


    }
    public function getNotParticipants(Request $request)
    {
        $params = $this->getParams($request);

        $project = $this->em->getRepository(Project::class)->find($params->project_id);

        $participants = $this->em->getRepository(Participant::class)->findBy(array(
            'project' => $project,
            'deleted' => false
        ));

        $participantIds = [];
        foreach ($participants as $elem) {
            array_push($participantIds, $elem->getUser()->getId());
        }
        $users = $this->em->getRepository(User::class)->findAll();
        $userIds = [];
        foreach ($users as $el) {
            array_push($userIds, $el->getId());
        }
        $toSendIds = [];
        foreach ($userIds as $o) {
            array_push($toSendIds, $o);
        }
        foreach ($participantIds as $n) {
            foreach ($userIds as $p) {
                if ($n == $p) {
                    if (($key = array_search($n, $toSendIds)) !== false) {
                        unset($toSendIds[$key]);
                    }

                }
            }
        }
        $nonPart = [];
        $count = 0;
        foreach ($toSendIds as $i) {
            array_push($nonPart, $i);
        }
        $nonPtToSend = [];
        foreach($nonPart as $non){
            array_push($nonPtToSend, $this->em->getRepository(User::class)->find($non));
        }



        return $this->getResponse([
                'users' => $nonPtToSend
            ]);




    }

    public function addParticipant(Request $request){
        $params = $this->getParams($request);

        $project = $this->em->getRepository(Project::class)->find($params->project_id);
        $user = $this->em->getRepository(User::class)->find($params->id);
        $search = $this->em->getRepository(Participant::class)->findBy(
            array('project'=> $project,
                  'user'=> $user));
        if($search) {
            $search[0]->setParticipantType($this->em->getRepository(ParticipantType::class)->find($params->participant_type));
            $search[0]->setDeleted(false);
            $this->em->persist($search[0]);
            $this->em->flush();
        }else{
            $participant = new Participant();
            $participant->setProject($project);
            $participant->setUser($user);
            $participant->setParticipantType($this->em->getRepository(ParticipantType::class)->find($params->participant_type));
            $participant->setDeleted(false);

            $this->em->persist($participant);
            $this->em->flush();
        }

        return $this->getSuccessResponse();
    }

    public function removeParticipant(Request $request){
        $params = $this->getParams($request);
        $project = $this->em->getRepository(Project::class)->find($params->project_id);
        $participant = $this->em->getRepository(Participant::class)->findBy(array(
            'id' => $params->id,
            'project' => $project
        ));
        $participant[0]->setDeleted(true);
        $this->em->persist($participant[0]);
        $this->em->flush();



        return $this->getSuccessResponse();

    }

    public function getParticipantsForProject(Request $request){
        $params = $this->getParams($request);

        $etape = $this->em->getRepository(Etape::class)->find($params->etape_id);

        $project = $etape->getProject();
        $participants = $this->em->getRepository(Participant::class)->findBy(
            array('project' => $project,
                  'deleted' => false)
        );

        return $this->getResponse([
            'participants' => $participants
        ]);


    }

    public function getParticipantType(){
        $participant_types = $this->em->getRepository(ParticipantType::class)->findAll();

        return $this->getResponse([
            'participant_types' => $participant_types
        ]);
    }

    public function getParticipantForTask(Request $request){
        $params = $this->getParams($request);

        $task = $this->em->getRepository(Task::class)->find($params->id);

        $participant = $task->getParticipant();

        return $this->getResponse([
            'participant' => $participant
        ]);
    }

    public function getProjectsForParticipant(Request $request){
        $params = $this->getParams($request);

        $user = $this->em->getRepository(User::class)->find($params->userId);
        $participant = $this->em->getRepository(Participant::class)->findBy([
            'user' => $user,
            'deleted' => false
        ]);
        $projects = [];
        if($participant) {
            foreach ($participant as $i) {
                array_push($projects, $i->getProject());
            }
        }

        return $this->getResponse([
            'projects' => $projects
        ]);
    }


}