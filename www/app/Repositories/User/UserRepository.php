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

    public function find(int $id)
    {
        return $this->user->find($id);
    }
}
