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

    /**
     * Get the project with project images
     *
     * @return array json object
     */
    public function getAllProjectImages()
    {
        return $this->project->select('id', 'image', 'name', 'description', 'role', 'live_link', 'github_link', 'created_at', 'deleted_at', 'updated_at', 'user_id' )
                                ->with(['projectImages' => function($query){
                                    $query->select('id', 'caption', 'image', 'project_id');
                                }])
                                ->get();
    } 
}
