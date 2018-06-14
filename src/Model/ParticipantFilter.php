<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 11.5.18.
 * Time: 11.55
 */

namespace App\Model;


class ParticipantFilter
{
    protected $perPage;
    protected $page;
    protected $project;


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
    public function getProject()
    {
        return $this->project;
    }
    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

}