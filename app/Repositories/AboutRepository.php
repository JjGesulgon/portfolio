<?php

namespace App\Repositories;

use App\About;

class AboutRepository extends Repository
{
    /**
     * Create new instance of about repository.
     *
     * @param About About about model
     */
    public function __construct(About $about)
    {
        parent::__construct($about);
        $this->about = $about;
    }
     /**
     * Get the about
     *
     * @return array json object
     */
    public function getAbout()
    {
        return $this->model->first();
    }
}
