<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Manufacture;
use App\Repositories\Contracts\RepositoryInterface\ManufactureRepositoryInterface;
use App\Repositories\BaseRepository;

class ManufactureRepository extends BaseRepository implements ManufactureRepositoryInterface
{
    public function getModel()
    {
        return Manufacture::class;
    }

    public function getManufactureByCondition($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)->where('manufactures.deleted_at', '=', null)->get();

        if (isset($condition['key'])) {
            $query->where('name', 'like', '%'.$condition['key'].'%')
                  ->orWhere('code', 'like', '%'.$condition['key'].'%')
                  ->get();
        }

        return $query->paginate(6);
    }
}
