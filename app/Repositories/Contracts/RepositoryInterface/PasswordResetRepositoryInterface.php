<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface PasswordResetRepositoryInterface extends BaseRepositoryInterface
{
    public function findEmail($email);
    public function findToken($token);
    public function UpdateToken($email, $token);
}
