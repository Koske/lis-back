<?php

namespace App\Entity;

/**
 * Salary
 */
class Salary
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $bruto;

    /**
     * @var string
     */
    private $neto;

    /**
     * @var \DateTime
     */
    private $dateValid;

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
     * @var \App\Entity\User
     */
    private $user;

    public function getUnixDateValid() {
        return $this->dateValid->getTimestamp();
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
     * Set bruto
     *
     * @param string $bruto
     *
     * @return Salary
     */
    public function setBruto($bruto)
    {
        $this->bruto = $bruto;

        return $this;
    }

    /**
     * Get bruto
     *
     * @return string
     */
    public function getBruto()
    {
        return $this->bruto;
    }

    /**
     * Set neto
     *
     * @param string $neto
     *
     * @return Salary
     */
    public function setNeto($neto)
    {
        $this->neto = $neto;

        return $this;
    }

    /**
     * Get neto
     *
     * @return string
     */
    public function getNeto()
    {
        return $this->neto;
    }

    /**
     * Set dateValid
     *
     * @param \DateTime $dateValid
     *
     * @return Salary
     */
    public function setDateValid($dateValid)
    {
        $this->dateValid = $dateValid;

        return $this;
    }

    /**
     * Get dateValid
     *
     * @return \DateTime
     */
    public function getDateValid()
    {
        return $this->dateValid;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Salary
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
     * @return Salary
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
     * @return Salary
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
     * @return Salary
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
