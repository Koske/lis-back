<?php

namespace App\Entity;

/**
 * Project
 */
class Project
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var \DateTime
     */
    private $estimatedDuration;

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
     * @var boolean
     */
    private $finished;

    /**
     * @var \App\Entity\User
     */
    private $userCreated;


    public function getUnixStartDate() {
        return $this->startDate->getTimestamp();
    }

    public function getUnixEstimatedDuration() {
        return $this->estimatedDuration->getTimestamp();
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
     * Set name
     *
     * @param string $name
     *
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Project
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Project
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set estimatedDuration
     *
     * @param \DateTime $estimatedDuration
     *
     * @return Project
     */
    public function setEstimatedDuration($estimatedDuration)
    {
        $this->estimatedDuration = $estimatedDuration;

        return $this;
    }

    /**
     * Get estimatedDuration
     *
     * @return \DateTime
     */
    public function getEstimatedDuration()
    {
        return $this->estimatedDuration;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * Set finished
     *
     * @param boolean $finished
     *
     * @return Project
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * Get finished
     *
     * @return boolean
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * Set userCreated
     *
     * @param \App\Entity\User $userCreated
     *
     * @return Project
     */
    public function setUserCreated(\App\Entity\User $userCreated = null)
    {
        $this->userCreated = $userCreated;

        return $this;
    }

    /**
     * Get userCreated
     *
     * @return \App\Entity\User
     */
    public function getUserCreated()
    {
        return $this->userCreated;
    }
    /**
     * @var \App\Entity\ProjectType
     */
    private $projectType;

    private $totalCost;

    /**
     * @return mixed
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * @param mixed $totalCost
     */
    public function setTotalCost($totalCost)
    {
        $this->totalCost = $totalCost;
    }


    /**
     * @var \App\Entity\Currency
     */
    private $currency;

    /**
     * Set currency
     *
     * @param \App\Entity\Currency $currency
     *
     * @return Project
     */
    public function setCurrency(\App\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \App\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
    /**
     * Set projectType
     *
     * @param \App\Entity\ProjectType $projectType
     *
     * @return Project
     */
    public function setProjectType(\App\Entity\ProjectType $projectType = null)
    {
        $this->projectType = $projectType;

        return $this;
    }

    /**
     * Get projectType
     *
     * @return \App\Entity\ProjectType
     */
    public function getProjectType()
    {
        return $this->projectType;
    }
    /**
     * @var \App\Entity\Participant
     */
    private $participant;


    /**
     * Set participant
     *
     * @param \App\Entity\Participant $participant
     *
     * @return Project
     */
    public function setParticipant(\App\Entity\Participant $participant = null)
    {
        $this->participant = $participant;

        return $this;
    }

    /**
     * Get participant
     *
     * @return \App\Entity\Participant
     */
    public function getParticipant()
    {
        return $this->participant;
    }
}
