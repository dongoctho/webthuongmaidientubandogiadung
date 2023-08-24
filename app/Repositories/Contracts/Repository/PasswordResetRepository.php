<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\PasswordReset;
use App\Repositories\Contracts\RepositoryInterface\PasswordResetRepositoryInterface;
use App\Repositories\BaseRepository;

class PasswordResetRepository extends BaseRepository implements PasswordResetRepositoryInterface
{
    public function getModel()
    {
        return PasswordReset::class;
    }

    public function findEmail($email)
    {
        return $this->model->select(['*'])->where('email', '=', $email)->first();
    }

    public function findToken($token)
    {
        return $this->model->select(['*'])->where('token', '=', $token)->first();
    }

    public function UpdateToken($email, $token)
    {
        return $this->model->select(['*'])->where('email', '=', $email)->update(['token' => $token]);
    }
}
