<?php

namespace App\Entity;

/**
 * City
 */
class City
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
    private $zipCode;

    /**
     * @var \App\Entity\Country
     */
    private $country;

    /**
     * @var \App\Entity\BusinessClient
     */
    private $businessClient;


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
     * @return City
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
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return City
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set country
     *
     * @param \App\Entity\Country $country
     *
     * @return City
     */
    public function setCountry(\App\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \App\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set businessClient
     *
     * @param \App\Entity\BusinessClient $businessClient
     *
     * @return City
     */
    public function setBusinessClient(\App\Entity\BusinessClient $businessClient = null)
    {
        $this->businessClient = $businessClient;

        return $this;
    }

    /**
     * Get businessClient
     *
     * @return \App\Entity\BusinessClient
     */
    public function getBusinessClient()
    {
        return $this->businessClient;
    }
}
