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
    private $accountNumber;

    /**
     * @var \App\Entity\Bank
     */
    private $bank;

    /**
     * @var string
     */
    private $type;

    /**
     * @var boolean
     */
    private $deleted;

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }


    /**
     * Set bank
     *
     * @param \App\Entity\Bank $bank
     *
     * @return Account
     */
    public function setBank(\App\Entity\Bank $bank = null)
    {
        $this->bank = $bank;

        return $this;
    }

    /**
     * Get bank
     *
     * @return \App\Entity\Bank
     */
    public function getBank()
    {
        return $this->bank;
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

}
