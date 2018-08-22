<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 20.8.18.
 * Time: 10.17
 */

namespace App\Entity;


class Bank
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
    private $swift;

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
    public function getSwift(): string
    {
        return $this->swift;
    }

    /**
     * @param string $swift
     */
    public function setSwift(string $swift)
    {
        $this->swift = $swift;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
}