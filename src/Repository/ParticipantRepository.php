<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 11.5.18.
 * Time: 11.59
 */

namespace App\Repository;


use App\Model\ParticipantFilter;
use App\Model\ProjectFilter;
use Elastica\Query\BoolQuery;
use FOS\ElasticaBundle\Repository;
use Elastica\Query;
use Elastica\Query\Match;

class ParticipantRepository extends Repository
{
    public function search(ProjectFilter $projectFilter){

        $searchQuery = $this->getSearchQuery($projectFilter);
        if($projectFilter->getType() && ($projectFilter->getDateFrom() || $projectFilter->getDateTo())) {
            $searchQuery->addMust($this->getDateQuery($projectFilter->getDateFrom(), $projectFilter->getDateTo(), $projectFilter->getType()));
        }
//        foreach ($projectFilter->getProjects() as $p)
//            $searchQuery->addShould($this->getProjectQuery($p));

        $query = new Query();
        $query->setQuery($searchQuery);

        $adapter = $this->finder->createPaginatorAdapter($query);
        $result = $adapter->getResults($this->getOffset(1, 10), 10)->toArray();
        $count = $adapter->getTotalHits();

        return [
            'result'=> $result,
            'total'=> $count
        ];
    }

    private function getDateQuery($from, $to, $type){
        if($from!= '' && $to!= '') {
            $dateQuery = new Query\Range($type, [
                'gte' => ((new \DateTime($from))->setTime(0, 0, 0))->getTimestamp(),
                'lte' => ((new \DateTime($to))->setTime(23, 59, 59))->getTimestamp()
            ]);
        }else if($from!= '' && $to== ''){
            $dateQuery = new Query\Range($type, [
                'gte' => ((new \DateTime($from))->setTime(0, 0, 0))->getTimestamp()
            ]);
        }else if($from == '' && $to!= '') {
            $dateQuery = new Query\Range($type, [
                'lte' => ((new \DateTime($to))->setTime(23, 59, 59))->getTimestamp()
            ]);
        }

        return $dateQuery;
    }

    private function getSearchQuery(ProjectFilter $projectFilter){
        $boolQuery = new BoolQuery();
        $boolQuery->addMust($this->getDeletedQuery($projectFilter->getDeleted()));

        return $boolQuery;

    }

    private function getDeletedQuery($deleted) {
        $queryDeleted = new Match();
        $queryDeleted->setFieldQuery('deleted', $deleted);

        return $queryDeleted;
    }

    private function getOffset($page, $perPage) {

        return ($page - 1) * $perPage;
    }

    private function getUserQuery($user) {

        $userQuery = new BoolQuery();

        $query = new Match();
        $query->setFieldQuery('user.id', $user->getId());
        $userQuery->addShould($query);

        return $userQuery;
    }

    private function getProjectQuery($project) {

        $projectQuery = new BoolQuery();

        $query = new Match();
        $query->setFieldQuery('project.id', $project->getId());
        $projectQuery->addShould($query);

        return $projectQuery;
    }
}