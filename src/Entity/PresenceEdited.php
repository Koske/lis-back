<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 19.6.18.
 * Time: 14.12
 */

namespace App\Entity;

/**
 * PresenceEdited
 */
class PresenceEdited
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
    private $originalStart;

    /**
     * @var \DateTime
     */
    private $originalEnd;


    /**
     * @var \App\Entity\User
     */
    private $user;

    /**
     * @var \App\Entity\Presence
     */
    private $presence;



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
     * @return PresenceEdited
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
     * @return PresenceEdited
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
     * Set originalStart
     *
     * @param \DateTime $originalStart
     *
     * @return PresenceEdited
     */
    public function setOriginalStart($originalStart)
    {
        $this->originalStart = $originalStart;

        return $this;
    }

    /**
     * Get originalStart
     *
     * @return \DateTime
     */
    public function getOriginalStart()
    {
        return $this->originalStart;
    }

    /**
     * Set originalEnd
     *
     * @param \DateTime $originalEnd
     *
     * @return PresenceEdited
     */
    public function setOriginalEnd($originalEnd)
    {
        $this->originalEnd = $originalEnd;

        return $this;
    }

    /**
     * Get originalEnd
     *
     * @return \DateTime
     */
    public function getOriginalEnd()
    {
        return $this->originalEnd;
    }


    /**
     * Set presence
     *
     * @param \App\Entity\Presence $presence
     *
     * @return PresenceEdited
     */
    public function setPresence(\App\Entity\Presence $presence = null)
    {
        $this->presence = $presence;

        return $this;
    }

    /**
     * Get presence
     *
     * @return \App\Entity\Presence
     */
    public function getPresence()
    {
        return $this->presence;
    }

    /**
     * Set user
     *
     * @param \App\Entity\User $user
     *
     * @return PresenceEdited
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
     * @return PresenceEdited
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
     * @return PresenceEdited
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
     * @return PresenceEdited
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