<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 13.8.18.
 * Time: 14.00
 */

namespace App\Repository;

use App\Model\PresenceEditedFilter;
use FOS\ElasticaBundle\Repository;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\BoolQuery;


class PresenceEditedRepository extends Repository
{
    public function search(PresenceEditedFilter $presenceEditedFilter){
        $searchQuery = $this->getSearchQuery($presenceEditedFilter);

        if($presenceEditedFilter->getType() && ($presenceEditedFilter->getDateFrom() || $presenceEditedFilter->getDateTo())) {
            $searchQuery->addMust($this->getDateQuery($presenceEditedFilter->getDateFrom(), $presenceEditedFilter->getDateTo(), $presenceEditedFilter->getType()));
        }
        if($presenceEditedFilter->getUser())
            $searchQuery->addMust($this->getUserQuery($presenceEditedFilter->getUser()));

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

    private function getSearchQuery(PresenceEditedFilter $presenceEditedFilter){
        $boolQuery = new BoolQuery();
        $boolQuery->addMust($this->getDeletedQuery($presenceEditedFilter->getDeleted()));

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