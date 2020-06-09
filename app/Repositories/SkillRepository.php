<?php

namespace App\Repositories;

use App\Skill;

class SkillRepository extends Repository
{
    /**
     * Create new instance of skill repository.
     *
     * @param Skill Skill skill model
     */
    public function __construct(Skill $skill)
    {
        parent::__construct($skill);
        $this->skill = $skill;
    }
     /**
     * Get the skill
     *
     * @return array json object
     */
    public function getAll()
    {
        return $this->model->all();
    }
}
