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

    /**
     * Get the projects images with assigned projects
     *
     * @return array json object
     */
    public function paginateWithProjects(
        $request = null,
        $length = 10,
        $orderBy = 'desc',
        $removePage = true
    ) {
        if ($orderBy == null) {
            $orderBy = 'desc';
        }

        return $this->projectImages->select('id', 
                                     'caption', 
                                     'image',
                                     'project_id')
                    ->with(['project' => function($query){
                        $query->select('id', 'name');
                    }])
                    ->filter($request)
                    ->orderBy('created_at', $orderBy)
                    ->paginate($length)
                    ->withPath(
                        $this->model->createPaginationUrl($request, $removePage)
                    );
    }
}
