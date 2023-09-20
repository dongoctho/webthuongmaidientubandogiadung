<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Product;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    public function countProduct()
    {
        $query = $this->model->newQuery();
        $query->selectRaw("COUNT(id) as countProduct");

        return $query->get();
    }

    public function getProduct()
    {
        return $this->model->whereNull('deleted_at')->get();
    }

    public function findProduct($product_id)
    {
        return $this->model
        ->where('products.id', $product_id)
        ->where('products.deleted_at', '=', null)
        ->first();
    }

    public function findIdProduct($product_id)
    {
        return $this->model
        ->where('products.name', '=', $product_id)
        ->where('products.deleted_at', '=', null)
        ->first();
    }

    public function getByCondition($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)->where('products.deleted_at', '=', null)
                               ->where('storages.quantity', '>', '0')
                               ->join('storages', 'products.id', '=', 'storages.product_id');

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
        return $query->paginate(6);
    }

    public function getProductByCondition($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)->where('products.deleted_at', '=', null)->get();

        if (isset($condition['key'])) {
            $query->where('name', 'like', '%'.$condition['key'].'%')
                  ->orWhere('code', 'like', '%'.$condition['key'].'%')
                  ->orWhere('price', 'like', '%'.$condition['key'].'%')
            ->get();
        }

        return $query->paginate(6);
    }

    public function getProductByConditionAdmin($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)->where('products.deleted_at', '=', null)
                               ->where('storages.quantity', '>', '0')
                               ->join('storages', 'products.id', '=', 'storages.product_id');

        return $query->get();
    }

    public function getProductByCategory($category_id, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)->where('products.deleted_at', '=', null)
                               ->where('categories.deleted_at', '=', null)
                               ->where('storages.quantity', '>', '0')
                               ->where('products.category_id', '=', $category_id)
                               ->join('storages', 'products.id', '=', 'storages.product_id')
                               ->join('categories', 'products.category_id', '=', 'categories.id');

        return $query->get();
    }

}
