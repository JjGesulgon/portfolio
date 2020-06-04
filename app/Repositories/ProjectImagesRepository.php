<?php

namespace App\Repositories;

use App\ProjectImages;

class ProjectImagesRepository extends Repository
{
    /**
     * Create new instance of project_images repository.
     *
     * @param Project Project_images project_images model
     */
    public function __construct(ProjectImages $projectImages)
    {
        parent::__construct($projectImages);
        $this->projectImages = $projectImages;
    }
     /**
     * Get the projectImages
     *
     * @return array json object
     */
    public function getAll()
    {
        return $this->model->all();
    }
}
