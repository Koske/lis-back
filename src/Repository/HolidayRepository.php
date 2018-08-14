<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 13.8.18.
 * Time: 12.53
 */

namespace App\Repository;

use App\Model\HolidayFilter;
use FOS\ElasticaBundle\Repository;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\BoolQuery;

class HolidayRepository extends Repository
{
    public function search(HolidayFilter $holidayFilter){
        $searchQuery = $this->getSearchQuery($holidayFilter);

        if($holidayFilter->getType() && ($holidayFilter->getDateFrom() || $holidayFilter->getDateTo())) {
            $searchQuery->addMust($this->getDateQuery($holidayFilter->getDateFrom(), $holidayFilter->getDateTo(), $holidayFilter->getType()));
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

    private function getSearchQuery(HolidayFilter $holidayFilter){
        $boolQuery = new BoolQuery();
        $boolQuery->addMust($this->getDeletedQuery($holidayFilter->getDeleted()));

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