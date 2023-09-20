<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getUserByCondition($condition, array $column = ['*']);
    public function findUser($id);
    public function findEmail($email);
    public function newUser();
}
