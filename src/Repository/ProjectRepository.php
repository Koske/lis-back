<?php

namespace App\Repository;



use FOS\ElasticaBundle\Repository;
use App\Model\ProjectFilter;

class ProjectRepository extends Repository
{
    public function search(ProjectFilter $projectFilter)
    {
        $boolQuery = new \Elastica\Query\BoolQuery();

        if($projectFilter->getSearchTerm() !=null && $projectFilter->getSearchTerm() != '')
        {
            $querySearch = new\Elastica\Query\MultiMatch();
            $querySearch->setFuzziness(2);
            $querySearch->setQuery($projectFilter->getSearchTerm());
            $querySearch->setFields(['name']);
            $querySearch->setMinimumShouldMatch('50%');
            $boolQuery->addMust($querySearch);


        }

        $queryActive = new \Elastica\Query\Match();
        $queryActive->setFieldQuery('deleted', $projectFilter->getDeleted());
        $boolQuery->addMust($queryActive);

        if($projectFilter->getFinished()) {
            $finishedQuery = new \Elastica\Query\BoolQuery();

            $query = new \Elastica\Query\Match();
            $query->setFieldQuery('finished', $projectFilter->getFinished());
            $finishedQuery->addShould($query);
            $boolQuery->addMust($finishedQuery);
        }

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