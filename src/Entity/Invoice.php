<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 24.8.18.
 * Time: 16.22
 */

namespace App\Entity;


class Invoice
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateUpdated;

    /**
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $paymentMethod;

    /**
     * @var integer
     */
    private $serialNumber;

    /**
     * @var integer
     */
    private $year;

    /**
     * @var string
     */
    private $paymentDeadline;

    /**
     * @var \App\Entity\BusinessClient
     */
    private $businessClient;

    /**
     * @var \App\Entity\Company
     */
    private $company;

    /**
     * @var \App\Entity\Currency
     */
    private $currency;

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


    public function getUnixDateCreated() {
        return $this->dateCreated->getTimestamp();
    }
    /**
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     */
    public function setPaymentMethod(string $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return string
     */
    public function getPaymentDeadline(): string
    {
        return $this->paymentDeadline;
    }

    /**
     * @param string $paymentDeadline
     */
    public function setPaymentDeadline(string $paymentDeadline)
    {
        $this->paymentDeadline = $paymentDeadline;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year)
    {
        $this->year = $year;
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
     * @return int
     */
    public function getSerialNumber(): int
    {
        return $this->serialNumber;
    }

    /**
     * @param int $serialNumber
     */
    public function setSerialNumber(int $serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }



    /**
     * Set businessClient
     *
     * @param \App\Entity\BusinessClient $businessClient
     *
     * @return Invoice
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

    /**
     * Set company
     *
     * @param \App\Entity\Company $company
     *
     * @return Invoice
     */
    public function setCompany(\App\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \App\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set currency
     *
     * @param \App\Entity\Currency $currency
     *
     * @return Invoice
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpdated(): \DateTime
    {
        return $this->dateUpdated;
    }

    /**
     * @param \DateTime $dateUpdated
     */
    public function setDateUpdated(\DateTime $dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     */
    public function setDateCreated(\DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }


}