<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\User;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function newUser()
    {
        $query = $this->model->newQuery();
        $query->selectRaw("COUNT(users.id) as newUser")
              ->where("users.role", "=", "2");

        return $query->get();
    }

    public function findUser($id){
        return $this->model->where('google_id', $id)->first();
    }

    public function getUserByCondition($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)->where('users.deleted_at', '=', null)->get();

        if (isset($condition['key'])) {
            $query->where('name', 'like', '%'.$condition['key'].'%')
                  ->orWhere('email', 'like', '%'.$condition['key'].'%')
                  ->get();
        }

        return $query->paginate(6);
    }

    public function findEmail($email)
    {
        return $this->model->select(['*'])->where('users.email', '=', $email)->first();
    }
}
