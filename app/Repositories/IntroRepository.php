<?php

namespace App\Repositories;

use App\Intro;

class IntroRepository extends Repository
{
    /**
     * Create new instance of intro repository.
     *
     * @param Intro Intro intro model
     */
    public function __construct(Intro $intro)
    {
        parent::__construct($intro);
        $this->intro = $intro;
    }
     /**
     * Get the intro
     *
     * @return array json object
     */
    public function getIntro()
    {
        return $this->model->first();
    }
}
