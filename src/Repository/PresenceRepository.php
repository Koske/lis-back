<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 13.8.18.
 * Time: 15.52
 */

namespace App\Repository;

use App\Model\PresenceFilter;
use FOS\ElasticaBundle\Repository;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\BoolQuery;

class PresenceRepository extends Repository
{
    public function search(PresenceFilter $presenceFilter){
        $searchQuery = $this->getSearchQuery($presenceFilter);

        if($presenceFilter->getType() && ($presenceFilter->getDateFrom() || $presenceFilter->getDateTo())) {
            $searchQuery->addMust($this->getDateQuery($presenceFilter->getDateFrom(), $presenceFilter->getDateTo(), $presenceFilter->getType()));
        }
        if($presenceFilter->getUser())
            $searchQuery->addMust($this->getUserQuery($presenceFilter->getUser()));

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

    private function getSearchQuery(PresenceFilter $presenceFilter){
        $boolQuery = new BoolQuery();
        $boolQuery->addMust($this->getDeletedQuery($presenceFilter->getDeleted()));

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
}