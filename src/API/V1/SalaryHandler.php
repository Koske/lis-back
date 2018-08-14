<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 18.7.18.
 * Time: 11.15
 */

namespace App\API\V1;


use App\Entity\Salary;
use App\Entity\User;
use App\Model\SalaryFilter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class SalaryHandler extends BaseHandler
{
    public function newSalary(Request $request)
    {
        $params = $this->getParams($request);
        $user = $this->em->getRepository(User::class)->find($params->user);
        $exists = $this->em->getRepository(Salary::class)->findBy([
            'user' => $user
        ]);
        if (!$exists) {
            $salary = new Salary();
            $salary->setBruto($params->bruto);
            $salary->setNeto($params->neto);
            $salary->setDateValid(new \DateTime($params->dateValid));
            $salary->setDateCreated(new \DateTime());
            $salary->setDateUpdated(new \DateTime());
            $salary->setDeleted(false);
            $salary->setUser($user);
            $this->em->persist($salary);
            $this->em->flush();

            return $this->getSuccessResponse();
        } else {
            return $this->getResponse(['Exists']);
        }
    }

    public function getSalaries(){
        $salaries = $this->em->getRepository(Salary::class)->findBy([
            'deleted' => false
        ]);

        return $this->getResponse(['salaries' => $salaries]);
    }

    public function removeSalary(Request $request){
        $params = $this->getParams($request);

        $salary = $this->em->getRepository(Salary::class)->find($params->id);
        $salary->setDeleted(true);
        $this->em->persist($salary);
        $this->em->flush();

        return $this->getSuccessResponse();

    }

    public function getSalaryById(Request $request){
        $params = $this->getParams($request);

        $salary = $this->em->getRepository(Salary::class)->find($params->id);

        return $this->getResponse(['salary' => $salary]);

    }

    public function editSalary(Request $request){
        $params = $this->getParams($request);

        $salary = $this->em->getRepository(Salary::class)->find($params->id);
        $user = $this->em->getRepository(User::class)->find($params->userId);
        $salary->setBruto($params->bruto);
        $salary->setNeto($params->neto);
        $salary->setDateValid(new \DateTime($params->dateValid));
        $salary->setDateUpdated(new \DateTime());
        $salary->setDeleted(false);
        $salary->setUser($user);

        $this->em->persist($salary);
        $this->em->flush();

        return $this->getSuccessResponse();

    }

    public function filterSalary(Request $request){
        $elasticManager = $this->container->get('fos_elastica.manager');
        $params = $this->getParams($request);
        $salaryFilter = new SalaryFilter();

        $salaryFilter->setDateFrom($params->startDate);
        $salaryFilter->setDateTo($params->endDate);
        $salaries = $elasticManager->getRepository(Salary::class)->search($salaryFilter);

        return $this->getResponse([
            'salaries' => $salaries['result'],
            'total' => $salaries['total']
        ]);
    }
}