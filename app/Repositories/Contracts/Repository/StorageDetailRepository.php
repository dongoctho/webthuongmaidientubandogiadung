<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\StorageDetail;
use App\Repositories\Contracts\RepositoryInterface\StorageDetailRepositoryInterface;
use App\Repositories\BaseRepository;

class StorageDetailRepository extends BaseRepository implements StorageDetailRepositoryInterface
{
    public function getModel()
    {
        return StorageDetail::class;
    }

    public function findStorage($storage_id)
    {
        return $this->model
        ->select('*')
        ->where('storage_id', $storage_id)
        ->where('deleted_at', '=', null)->get();
    }

    public function getStorageDetailByCondition($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)
            ->where('deleted_at', '=', null)
            ->orderByDesc('id')->get();

        // if (isset($condition['key'])) {
        //     $query->where('products.name', 'like', '%'.$condition['key'].'%')
        //           ->orwhere('quantity', 'like', '%'.$condition['key'].'%')
        //     ->get();
        // }

        return $query->paginate(6);
    }
}
