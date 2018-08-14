<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 8.8.18.
 * Time: 11.29
 */

namespace App\Repository;


use App\Model\BonusFilter;
use Elastica\Query\BoolQuery;
use FOS\ElasticaBundle\Repository;
use Elastica\Query;
use Elastica\Query\Match;

class BonusRepository extends Repository
{
    public function search(BonusFilter $bonusFilter){
        $searchQuery = $this->getSearchQuery($bonusFilter);
        if($bonusFilter->getType() && ($bonusFilter->getDateFrom() || $bonusFilter->getDateTo())) {
            $searchQuery->addMust($this->getDateQuery($bonusFilter->getDateFrom(), $bonusFilter->getDateTo(), $bonusFilter->getType()));
        }

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

    private function getSearchQuery(BonusFilter $bonusFilter){
        $boolQuery = new BoolQuery();
        $boolQuery->addMust($this->getDeletedQuery($bonusFilter->getDeleted()));

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
}