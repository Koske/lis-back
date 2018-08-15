<?php

namespace App\Repository;



use FOS\ElasticaBundle\Repository;
use App\Model\ProjectFilter;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\BoolQuery;


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

        if($projectFilter->getType() && ($projectFilter->getDateFrom() || $projectFilter->getDateTo())){
            $boolQuery->addMust($this->getDateQuery($projectFilter->getDateFrom(), $projectFilter->getDateTo(), $projectFilter->getType()));
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

    public function searchProjectByUser(ProjectFilter $projectFilter){

        $searchQuery = $this->getSearchQuery($projectFilter);
        if($projectFilter->getType() && ($projectFilter->getDateFrom() || $projectFilter->getDateTo())) {
            $searchQuery->addMust($this->getDateQuery($projectFilter->getDateFrom(), $projectFilter->getDateTo(), $projectFilter->getType()));
        }

        if($projectFilter->getFinished()) {
            $finishedQuery = new BoolQuery();

            $query = new Match();
            $query->setFieldQuery('finished', $projectFilter->getFinished());
            $finishedQuery->addShould($query);
            $searchQuery->addMust($finishedQuery);
        }

        $groupsQuery = new BoolQuery();

        foreach($projectFilter->getProjects() as $p) {
            $groupQuery = new Match();
            $groupQuery->setField('id', $p->getId());
            $groupsQuery->addShould($groupQuery);
        }

        $searchQuery->addMust($groupsQuery);





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
        if($from!= null && $to!= null) {
            $dateQuery = new Query\Range($type, [
                'gte' => ((new \DateTime($from))->setTime(0, 0, 0))->getTimestamp(),
                'lte' => ((new \DateTime($to))->setTime(23, 59, 59))->getTimestamp()
            ]);
        }else if($from!= null && $to== null){
            $dateQuery = new Query\Range($type, [
                'gte' => ((new \DateTime($from))->setTime(0, 0, 0))->getTimestamp()
            ]);
        }else if($from == null && $to!= null){
            $dateQuery = new Query\Range($type, [
                'lte' => ((new \DateTime($to))->setTime(23, 59, 59))->getTimestamp()
            ]);
        }
        return $dateQuery;
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

    private function getDeletedQuery($deleted) {
        $queryDeleted = new Match();
        $queryDeleted->setFieldQuery('deleted', $deleted);

        return $queryDeleted;
    }

    private function getSearchQuery(ProjectFilter $projectFilter){
        $boolQuery = new BoolQuery();
        $boolQuery->addMust($this->getDeletedQuery($projectFilter->getDeleted()));

        return $boolQuery;

    }


    private function getProjectQuery($project) {

        $projectQuery = new BoolQuery();

        $query = new Match();
        $query->setFieldQuery('id', $project->getId());
        $projectQuery->addShould($query);

        return $projectQuery;
    }


}