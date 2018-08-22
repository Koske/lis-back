<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 16.8.18.
 * Time: 11.29
 */

namespace App\API\V1;


use App\Entity\Currency;
use App\Entity\Project;
use App\Entity\ProjectExpense;
use Symfony\Component\HttpFoundation\Request;

class ProjectExpenseHandler extends BaseHandler
{
    public function newProjectExpense(Request $request){
        $params = $this->getParams($request);

        $projectExpense = new ProjectExpense();
        $currency = $this->em->getRepository(Currency::class)->find($params->currency);
        $project = $this->em->getRepository(Project::class)->find($params->project);

        $project->setCurrency($currency);
        $project->setTotalCost($project->getTotalCost()+ $params->amount);
        $projectExpense->setDateCreated(new \DateTime());
        $projectExpense->setDateUpdated(new \DateTime());
        $projectExpense->setDeleted(false);
        $projectExpense->setAmount($params->amount);
        $projectExpense->setCurrency($currency);
        $projectExpense->setDescription($params->description);
        $projectExpense->setProject($project);

        $this->em->persist($project);
        $this->em->flush();

        $this->em->persist($projectExpense);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getAllProjectExpenses(){
        $projectExpenses = $this->em->getRepository(ProjectExpense::class)->findBy(['deleted'=> false]);

        return $this->getResponse(['expenses'=> $projectExpenses]);
    }

    public function removeProjectExpense(Request $request){
        $params = $this->getParams($request);

        $projectExpense = $this->em->getRepository(ProjectExpense::class)->find($params->id);
        $project = $projectExpense->getProject();
        $project->setTotalCost($project->getTotalCost()- $projectExpense->getAmount());

        $projectExpense->setDeleted(true);
        $projectExpense->setDateUpdated(new \DateTime());


        $this->em->persist($projectExpense);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function editProjectExpense(Request $request){
        $params = $this->getParams($request);

        $project = $this->em->getRepository(Project::class)->find($params->project);
        $projectExpense = $this->em->getRepository(ProjectExpense::class)->find($params->id);
        $currency = $this->em->getRepository(Currency::class)->find($params->currency);

        $projectExpense->setDateUpdated(new \DateTime());
        $projectExpense->setAmount($params->amount);
        $projectExpense->setDescription($params->description);
        $projectExpense->setProject($project);
        $projectExpense->setCurrency($currency);

        $this->em->persist($projectExpense);
        $this->em->flush();

        return $this->getSuccessResponse();
    }

    public function getProjectExpenseById(Request $request){
        $params = $this->getParams($request);

        $projectExpense = $this->em->getRepository(ProjectExpense::class)->find($params->id);

        return $this->getResponse(['projectExpense'=> $projectExpense]);
    }
}