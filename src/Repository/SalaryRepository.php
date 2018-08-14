<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 10.8.18.
 * Time: 16.08
 */

namespace App\Repository;
use App\Model\SalaryFilter;
use Elastica\Query\BoolQuery;
use FOS\ElasticaBundle\Repository;
use Elastica\Query;
use Elastica\Query\Match;

class SalaryRepository extends Repository
{
    public function search(SalaryFilter $salaryFilter){
        $searchQuery = $this->getSearchQuery();
        if($salaryFilter->getDateFrom() || $salaryFilter->getDateTo()) {
            $searchQuery->addMust($this->getDateQuery($salaryFilter->getDateFrom(), $salaryFilter->getDateTo()));
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

    private function getDateQuery($from, $to){
        if($from!= '' && $to!= '') {
            $dateQuery = new Query\Range('unixDateValid', [
                'gte' => ((new \DateTime($from))->setTime(0, 0, 0))->getTimestamp(),
                'lte' => ((new \DateTime($to))->setTime(23, 59, 59))->getTimestamp()
            ]);
        }else if($from!= '' && $to== ''){
            $dateQuery = new Query\Range('unixDateValid', [
                'gte' => ((new \DateTime($from))->setTime(0, 0, 0))->getTimestamp()
            ]);
        }else if($from == '' && $to!= '') {
            $dateQuery = new Query\Range('unixDateValid', [
                'lte' => ((new \DateTime($to))->setTime(23, 59, 59))->getTimestamp()
            ]);
        }

        return $dateQuery;
    }

    private function getSearchQuery(){
        $boolQuery = new BoolQuery();
        $boolQuery->addMust($this->getDeletedQuery(false));

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