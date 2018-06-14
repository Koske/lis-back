<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 4/11/18
 * Time: 2:01 PM
 */
namespace App\Model;
class ProjectFilter
{
    protected $perPage;
    protected $page;
    protected $search_term;
    protected $project_type;
    protected $name;
    protected $description;
    protected $dateStarted;
    protected $userCreated;
    protected $deleted;
    protected $finished;
    /**
     * @return mixed
     */
    public function getSearchTerm()
    {
        return $this->search_term;
    }
    /**
     * @param mixed $search_term
     */
    public function setSearchTerm($search_term)
    {
        $this->search_term = $search_term;
    }
    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->perPage;
    }
    /**
     * @param mixed $perPage
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }
    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }
    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }
    /**
     * @return mixed
     */
    public function getProjectType()
    {
        return $this->project_type;
    }
    /**
     * @param mixed $project_type
     */
    public function setProjectType($project_type)
    {
        $this->project_type = $project_type;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function getDateStarted()
    {
        return $this->dateStarted;
    }
    /**
     * @param mixed $dateStarted
     */
    public function setDateStarted($dateStarted)
    {
        $this->dateStarted = $dateStarted;
    }
    public function getUserCreated()
    {
        return $this->userCreated;
    }
    /**
     * @param mixed $userCreated
     */
    public function setUserCreated($userCreated)
    {
        $this->dateStarted = $userCreated;
    }
    public function getDeleted()
    {
        return $this->deleted;
    }
    /**
     * @param mixed $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    public function getFinished()
    {
        return $this->finished;
    }
    /**
     * @param mixed $finished
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
    }
}