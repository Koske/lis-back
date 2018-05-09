<?php

namespace App\Repository;



use FOS\ElasticaBundle\Repository;
use App\Model\ProjectFilter;

class ProjectRepository extends Repository
{
    public function search(ProjectFilter $projectFilter)
    {
        $boolQuery = new \Elastica\Query\BoolQuery();

        $queryActive = new \Elastica\Query\Match();
        $queryActive->setFieldQuery('deleted', $projectFilter->getDeleted());
        $boolQuery->addMust($queryActive);


        $query = new \Elastica\Query();
        $query->setQuery($boolQuery);

        $adapter = $this->finder->createPaginatorAdapter($query);
        $result = $adapter->getResults(($projectFilter->getPage() - 1) * $projectFilter->getPerPage(), $projectFilter->getPerPage())->toArray();
        $count = $adapter->getTotalHits();

        return array(
            'total' => $count,
            'result' => $result
        );
    }
}