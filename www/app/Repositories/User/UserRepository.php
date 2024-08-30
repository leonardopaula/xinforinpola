<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $model)
    {
        $this->user = $model;
    }

    /**
     * Returns user by id
     *
     * @param integer $id
     * @return User
     */
    public function find(int $id)
    {
        return $this->user->find($id);
    }
}
