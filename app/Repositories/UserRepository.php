<?php

namespace App\Repositories;

use App\User;

class UserRepository extends Repository
{
    /**
     * Create new instance of user repository.
     *
     * @param User user User model
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }
}
