<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 11.5.18.
 * Time: 11.59
 */

namespace App\Repository;


use App\Model\ParticipantFilter;
use FOS\ElasticaBundle\Repository;

class ParticipantRepository extends Repository
{
    public function search(ParticipantFilter $participantFilter)
    {
        $boolQuery = new \Elastica\Query\BoolQuery();



        $queryActive = new \Elastica\Query\Match();
        $queryActive->setFieldQuery('project.id', $participantFilter->getProject());
        $boolQuery->addMust($queryActive);


        $query = new \Elastica\Query();
        $query->setQuery($boolQuery);

        $adapter = $this->finder->createPaginatorAdapter($query);
        $result = $adapter->getResults(($participantFilter->getPage() - 1) * $participantFilter->getPerPage(), $participantFilter->getPerPage())->toArray();
        $count = $adapter->getTotalHits();

        return array(
            'total' => $count,
            'result' => $result
        );
    }
}