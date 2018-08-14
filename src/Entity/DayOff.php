<?php

namespace App\Entity;

/**
 * DayOff
 */
class DayOff
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
     * @var string
     */
    private $reasonDeclined;

    /**
     * @var string
     */
    private $status;

    /**
     * @var integer
     */
    private $workdays;


    public function getUnixStartDate() {
        return $this->start->getTimestamp();
    }

    public function getUnixEndDate() {
        return $this->end->getTimestamp();
    }

    /**
     * @return int
     */
    public function getWorkdays(): int
    {
        return $this->workdays;
    }

    /**
     * @param int $workdays
     */
    public function setWorkdays(int $workdays)
    {
        $this->workdays = $workdays;
    }





    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @var \App\Entity\User
     */
    private $user;

    /**
     * @return string
     */
    public function getReasonDeclined(): string
    {
        return $this->reasonDeclined;
    }

    /**
     * @param string $reasonDeclined
     */
    public function setReasonDeclined(string $reasonDeclined)
    {
        $this->reasonDeclined = $reasonDeclined;
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
     * Set start
     *
     * @param \DateTime $start
     *
     * @return DayOff
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
     * @return DayOff
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return DayOff
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
     * @return DayOff
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
     * @return DayOff
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

    /**
     * Set user
     *
     * @param \App\Entity\User $user
     *
     * @return DayOff
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
}
