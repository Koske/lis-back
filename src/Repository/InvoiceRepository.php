<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 5.9.18.
 * Time: 12.55
 */

namespace App\Repository;

use App\Model\InvoiceFilter;
use FOS\ElasticaBundle\Repository;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\BoolQuery;

class InvoiceRepository extends Repository
{

    public function search(InvoiceFilter $invoiceFilter){
        $searchQuery = $this->getSearchQuery($invoiceFilter);

        if($invoiceFilter->getDateFrom() || $invoiceFilter->getDateTo()) {
            $searchQuery->addMust($this->getDateQuery($invoiceFilter->getDateFrom(), $invoiceFilter->getDateTo()));
        }
        if($invoiceFilter->getType()!=null)
            $searchQuery->addMust($this->getTypeQuery($invoiceFilter->getType()));

        if($invoiceFilter->getBusinessClient()!=null)
            $searchQuery->addMust($this->getBusinessClientQuery($invoiceFilter->getBusinessClient()));

        if($invoiceFilter->getCompany()!=null)
            $searchQuery->addMust($this->getCompanyQuery($invoiceFilter->getCompany()));

        $query = new Query();
        $query->setQuery($searchQuery);

        $adapter = $this->finder->createPaginatorAdapter($query);
        $count = $adapter->getTotalHits();

        $result = $adapter->getResults($this->getOffset(1, $count), $count)->toArray();

        return [
            'result'=> $result,
            'total'=> $count
        ];
    }

    private function getDateQuery($from, $to){
        if($from!= null && $to!= null) {
            $dateQuery = new Query\Range('unixDateCreated', [
                'gte' => ((new \DateTime($from))->setTime(0, 0, 0))->getTimestamp(),
                'lte' => ((new \DateTime($to))->setTime(23, 59, 59))->getTimestamp()
            ]);
        }else if($from!= null && $to== null){
            $dateQuery = new Query\Range('unixDateCreated', [
                'gte' => ((new \DateTime($from))->setTime(0, 0, 0))->getTimestamp()
            ]);
        }else if($from == null && $to!= null) {
            $dateQuery = new Query\Range('unixDateCreated', [
                'lte' => ((new \DateTime($to))->setTime(23, 59, 59))->getTimestamp()
            ]);
        }

        return $dateQuery;
    }

    private function getSearchQuery(InvoiceFilter $invoiceFilter){
        $boolQuery = new BoolQuery();
        $boolQuery->addMust($this->getDeletedQuery($invoiceFilter->getDeleted()));

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

    private function getBusinessClientQuery($businessClient){
        $businessClientQuery = new BoolQuery();

        $query = new Match();
        $query->setFieldQuery('business_client.id', $businessClient->getId());
        $businessClientQuery->addShould($query);

        return $businessClientQuery;
    }

    private function getCompanyQuery($company){
        $companyQuery = new BoolQuery();

        $query = new Match();
        $query->setFieldQuery('company.id', $company->getId());
        $companyQuery->addShould($query);

        return $companyQuery;
    }

    private function getTypeQuery($type){
        $typeQuery = new BoolQuery();

        $query = new Match();
        $query->setFieldQuery('type', $type);
        $query->setFieldMinimumShouldMatch('type','100%');
        $query->setFieldFuzziness('type', 0);

        if($type == 'Domaci'){
            $type2 = 'Domaci PDV';
            $query2 = new Match();
            $query2->setFieldQuery('type', $type2);
            $query2->setFieldMinimumShouldMatch('type', '100%');

            $typeQuery->addMustNot($query2);
        }

        $typeQuery->addShould($query);


        return $typeQuery;
    }
}