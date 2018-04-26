<?php

namespace App\Entity;

/**
 * Participant
 */
class Participant
{
    /**
     * @var integer
     */
    private $id;


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
     * @var \App\Entity\ParticipantType
     */
    private $participantType;


    /**
     * Set participantType
     *
     * @param \App\Entity\ParticipantType $participantType
     *
     * @return Participant
     */
    public function setParticipantType(\App\Entity\ParticipantType $participantType = null)
    {
        $this->participantType = $participantType;

        return $this;
    }

    /**
     * Get participantType
     *
     * @return \App\Entity\ParticipantType
     */
    public function getParticipantType()
    {
        return $this->participantType;
    }
    /**
     * @var \App\Entity\Participant
     */
    private $participant;

    /**
     * @var \App\Entity\User
     */
    private $user;


    /**
     * Set participant
     *
     * @param \App\Entity\Participant $participant
     *
     * @return Participant
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

    /**
     * Set user
     *
     * @param \App\Entity\User $user
     *
     * @return Participant
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
