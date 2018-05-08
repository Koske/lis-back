<?php

namespace App\Entity;

/**
 * Account
 */
class Account
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $bank;

    /**
     * @var string
     */
    private $accountNumber;

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
     * Set bank
     *
     * @param string $bank
     *
     * @return Account
     */
    public function setBank($bank)
    {
        $this->bank = $bank;

        return $this;
    }

    /**
     * Get bank
     *
     * @return string
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Set accountNumber
     *
     * @param string $accountNumber
     *
     * @return Account
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * Get accountNumber
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Set businessClient
     *
     * @param \App\Entity\BusinessClient $businessClient
     *
     * @return Account
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