<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 27.7.18.
 * Time: 10.58
 */

namespace App\Entity;


class DaysOffStats
{
    /**
     * Set user
     *
     * @param \App\Entity\User $user
     *
     * @return DaysOffStats
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
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $year;

    /**
     * @var integer
     */
    private $daysOff;

    /**
     * @return int
     */
    public function getDaysOff(): int
    {
        return $this->daysOff;
    }

    /**
     * @param int $daysOff
     */
    public function setDaysOff(int $daysOff)
    {
        $this->daysOff = $daysOff;
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
     * @var \App\Entity\User
     */
    private $user;

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


}