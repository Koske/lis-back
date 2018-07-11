<?php
/**
 * Created by PhpStorm.
 * User: srdjan
 * Date: 2.4.18.
 * Time: 15.11
 */

namespace App\Repository;

use App\Model\UserFilter;
use FOS\ElasticaBundle\Repository;

class UserRepository extends Repository
{
    public function search(UserFilter $userFilter)
    {
        $boolQuery = new \Elastica\Query\BoolQuery();

        if($userFilter->getSearchTerm() !=null && $userFilter->getSearchTerm() != '')
        {
            $query = new\Elastica\Query\MultiMatch();
            $query->setFuzziness(2);
            $query->setQuery($userFilter->getSearchTerm());
            $query->setFields(['firstName', 'lastName']);
            $query->setMinimumShouldMatch('50%');
            $boolQuery->addMust($query);


        }

        $queryDelete = new\Elastica\Query\Match();
        $queryDelete->setFieldQuery('deleted', $userFilter->getDeleted());
        $boolQuery->addMust($queryDelete);

//        $userTypesCount = count($userFilter->getUserType());
//
//        if($userTypesCount != 0)
//        {
//            $userTypeQuery = new \Elastica\Query\BoolQuery();
//
//            foreach ($userFilter->getUserType() as $userType)
//            {
//                $query = new \Elastica\Query\Match();
//                $query->setFieldQuery('userType', $userType);
//                $userTypeQuery->addShould($query);
//            }
//
//            $boolQuery->addMust($userTypeQuery);
//        }
//
//        $positionsCount = count($userFilter->getPosition());
//
//        if($positionsCount != 0)
//        {
//            $positionsQuery = new \Elastica\Query\BoolQuery();
//
//            foreach ($userFilter->getUserType() as $position)
//            {
//                $query = new \Elastica\Query\Match();
//                $query->setFieldQuery('position', $position);
//                $positionsQuery->addShould($query);
//            }
//
//            $boolQuery->addMust($positionsQuery);
//        }
//
//        $teamsCount = count($userFilter->getTeam());
//
//        if($teamsCount != 0)
//        {
//            $teamQuery = new \Elastica\Query\BoolQuery();
//
//            foreach ($userFilter->getUserType() as $team)
//            {
//                $query = new \Elastica\Query\Match();
//                $query->setFieldQuery('team', $team);
//                $teamQuery->addShould($query);
//            }
//
//            $boolQuery->addMust($teamQuery);
//        }
//
        $query = new \Elastica\Query();

        $query->setQuery($boolQuery);
        $query->setSort(array('id' => array('order' => 'asc')));

        $adapter = $this->finder->createPaginatorAdapter($query);
        $result = $adapter->getResults(($userFilter->getPage() - 1) * $userFilter->getPerPage(), $userFilter->getPerPage())->toArray();
        $count = $adapter->getTotalHits();

        return array(
            'total' => $count,
            'result' => $result
        );
    }
}