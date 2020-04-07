<?php

namespace App\Repositories;

use App\Experience;

class ExperienceRepository extends Repository
{
    /**
     * Create new instance of experience repository.
     *
     * @param Experience Experience experience model
     */
    public function __construct(Experience $experience)
    {
        parent::__construct($experience);
        $this->experience = $experience;
    }
     /**
     * Get the about
     *
     * @return array json object
     */
    public function getAll()
    {
        return $this->model->all();
    }
}
