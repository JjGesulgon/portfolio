<?php

namespace App\Repositories;

use App\Project;

class ProjectRepository extends Repository
{
    /**
     * Create new instance of project repository.
     *
     * @param Project Project project model
     */
    public function __construct(Project $project)
    {
        parent::__construct($project);
        $this->project = $project;
    }
     /**
     * Get the project
     *
     * @return array json object
     */
    public function getAll()
    {
        return $this->model->all();
    }
}
