<?php

namespace App\Entity;

/**
 * Presence
 */
class Presence
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @var boolean
     */
    private $closed;

    /**
     * @var boolean
     */
    private $autoClosed;

    /**
     * @var boolean
     */
    private $eightHours;

    /**
     * @var boolean
     */
    private $businessCheckOut;

    /**
     * @var integer
     */
    private $year;

    /**
     * @var integer
     */
    private $month;

    /**
     * @var \App\Entity\User
     */
    private $user;

    public function getUnixStartDate() {
        if($this->start!= null)
            return $this->start->getTimestamp();
        return 'No start date';
    }

    public function getUnixEndDate() {
        if($this->end!= null)
            return $this->end->getTimestamp();
        return 'No end date';
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Presence
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set month
     *
     * @param integer $month
     *
     * @return Presence
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return integer
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Presence
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return Presence
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }
    /**
     * Set autoClosed
     *
     * @param boolean $autoClosed
     *
     * @return Presence
     */
    public function setAutoClosed($autoClosed)
    {
        $this->autoClosed = $autoClosed;

        return $this;
    }

    /**
     * Get autoClosed
     *
     * @return boolean
     */
    public function getAutoClosed()
    {
        return $this->autoClosed;
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     *
     * @return Presence
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return boolean
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set eightHours
     *
     * @param boolean $eightHours
     *
     * @return Presence
     */
    public function setEightHours($eightHours)
    {
        $this->eightHours = $eightHours;

        return $this;
    }

    /**
     * Get eightHours
     *
     * @return boolean
     */
    public function getEightHours()
    {
        return $this->eightHours;
    }

    /**
     * Set businessCheckOut
     *
     * @param boolean $businessCheckOut
     *
     * @return Presence
     */
    public function setBusinessCheckOut($businessCheckOut)
    {
        $this->businessCheckOut = $businessCheckOut;

        return $this;
    }

    /**
     * Get businessCheckOut
     *
     * @return boolean
     */
    public function getBusinessCheckOut()
    {
        return $this->businessCheckOut;
    }

    /**
     * Set user
     *
     * @param \App\Entity\User $user
     *
     * @return Presence
     */
    public function setUser(\App\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \App\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @var \DateTime
     */
    private $dateUpdated;

    /**
     * @var boolean
     */
    private $deleted;


    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Presence
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     *
     * @return Presence
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return Presence
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}
