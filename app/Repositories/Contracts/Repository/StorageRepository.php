<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Storage;
use App\Repositories\Contracts\RepositoryInterface\StorageRepositoryInterface;
use App\Repositories\BaseRepository;

class StorageRepository extends BaseRepository implements StorageRepositoryInterface
{
    public function getModel()
    {
        return Storage::class;
    }

    public function getStorageByCondition($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)
            ->where('storages.deleted_at', '=', null)
            ->where('storages.quantity', '>', '0')
            ->join('products', 'storages.product_id', '=', 'products.id')->get();

        if (isset($condition['key'])) {
            $query->where('products.name', 'like', '%'.$condition['key'].'%')
                  ->orwhere('quantity', 'like', '%'.$condition['key'].'%')
            ->get();
        }

        return $query->paginate(6);
    }

    public function updateProductId($id, $attributes = [])
    {
        $result = $this->model->where('product_id', $id)->first();
        if($result){
            $result->update($attributes);

            return $result;
        }

        return false;
    }

    public function findProduct($product_id)
    {
        return $this->model
        ->where('product_id', $product_id)
        ->where('storages.deleted_at', '=', null)
        ->first();
    }

    public function getProductSale($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)->where('storages.deleted_at', '=', null)
                               ->join('products', 'products.id', '=', 'storages.product_id')
                               ->where('products.sale', '>', 0)
                               ->where('storages.quantity', '>', '0')
                               ->orderByDesc('sale')
                               ->limit(8);

        if (isset($condition['seachByPrice'])) {
            if ($condition['seachByPrice'] == 1) {
                $query->where('price', '<=', 50000);
            }
            if ($condition['seachByPrice'] == 2) {
                $query->where('price', '>', 50000)
                      ->where('price', '<=', 200000);
            }
            if ($condition['seachByPrice'] == 3) {
                $query->where('price', '>', 200000)
                      ->where('price', '<=', 500000);
            }
            if ($condition['seachByPrice'] == 4) {
                $query->where('price', '>', 500000)
                      ->where('price', '<=', 2000000);
            }
            if ($condition['seachByPrice'] == 5) {
                $query->where('price', '>', 2000000);
            }
        }

        if (isset($condition['seachByCategory'])) {
            $query->where('category_id', '=', $condition['seachByCategory']);
        }

        if (isset($condition['findProductByName'])) {
            $query->where('name', 'like', '%'.$condition['findProductByName'].'%')
            ->get();
        }
        return $query->get();
    }


}
