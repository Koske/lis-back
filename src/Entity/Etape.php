<?php

namespace App\Entity;

/**
 * Etape
 */
class Etape
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
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @var \App\Entity\Project
     */
    private $project;

    /**
     * @var integer
     */
    private $hoursCompleted;

    /**
     * @var integer
     */
    private $hoursNotCompleted;

    /**
     * @var integer
     */
    private $tasksCompleted;

    /**
     * @var integer
     */
    private $tasksNotCompleted;


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
     * @return Etape
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
     * Set hoursCompleted
     *
     * @param integer $hoursCompleted
     *
     * @return Etape
     */
    public function setHoursCompleted($hoursCompleted)
    {
        $this->hoursCompleted = $hoursCompleted;

        return $this;
    }

    /**
     * Get hoursCompleted
     *
     * @return integer
     */
    public function getHoursCompleted()
    {
        return $this->hoursCompleted;
    }

    /**
     * Set tasksCompleted
     *
     * @param integer $tasksCompleted
     *
     * @return Etape
     */
    public function setTasksCompleted($tasksCompleted)
    {
        $this->tasksCompleted = $tasksCompleted;

        return $this;
    }

    /**
     * Get tasksCompleted
     *
     * @return integer
     */
    public function getTasksCompleted()
    {
        return $this->tasksCompleted;
    }

    /**
     * Set tasksNotCompleted
     *
     * @param integer $tasksNotCompleted
     *
     * @return Etape
     */
    public function setTasksNotCompleted($tasksNotCompleted)
    {
        $this->tasksNotCompleted = $tasksNotCompleted;

        return $this;
    }

    /**
     * Get tasksNotCompleted
     *
     * @return integer
     */
    public function getTasksNotCompleted()
    {
        return $this->tasksNotCompleted;
    }

    /**
     * Set hoursNotCompleted
     *
     * @param integer $hoursNotCompleted
     *
     * @return Etape
     */
    public function setHoursNotCompleted($hoursNotCompleted)
    {
        $this->hoursNotCompleted = $hoursNotCompleted;

        return $this;
    }

    /**
     * Get hoursNotCompleted
     *
     * @return integer
     */
    public function getHoursNotCompleted()
    {
        return $this->hoursNotCompleted;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Etape
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
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Etape
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
     * @return Etape
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
     * Set project
     *
     * @param \App\Entity\Project $project
     *
     * @return Etape
     */
    public function setProject(\App\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \App\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
