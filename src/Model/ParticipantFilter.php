<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 11.5.18.
 * Time: 11.55
 */

namespace App\Model;


class ParticipantFilter
{
    protected $perPage;
    protected $page;
    protected $deleted;
    protected $participants;
    protected $type;
    protected $dateFrom;
    protected $dateTo;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * @param mixed $dateFrom
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
    }

    /**
     * @return mixed
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * @param mixed $dateTo
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param mixed $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @return mixed
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param mixed $participants
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;
    }




    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->perPage;
    }
    /**
     * @param mixed $perPage
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }
    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }
    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }


}