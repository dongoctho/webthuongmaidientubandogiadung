<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\CartDetail;
use App\Repositories\Contracts\RepositoryInterface\CartDetailRepositoryInterface;
use App\Repositories\BaseRepository;

class CartDetailRepository extends BaseRepository implements CartDetailRepositoryInterface
{
    public function getModel()
    {
        return CartDetail::class;
    }

    public function findProduct($product_id)
    {
        return $this->model->where('product_id', $product_id)->first();
    }

    public function getDetailCart($userId, array $column = ['*'])
    {
        $query = $this->model->select($column);

        $query->leftjoin('carts', 'carts_detail.cart_id', '=', 'carts.id')
              ->leftjoin('products', 'carts_detail.product_id', '=', 'products.id')
              ->leftjoin('storages', 'carts_detail.product_id', '=', 'storages.product_id');
        $query->where('user_id' , '=', $userId)
              ->whereNull('carts.deleted_at');

        return $query->get();

    }

    public function getCartDetail($userId, $id)
    {
        $query = $this->model
            ->where('user_id', $userId)
            ->where('carts_detail.deleted_at', null)
            ->where('carts_detail.cart_id', '=', $id)
            ->orderByDesc('carts_detail.id')
            ->join('carts', 'carts.id', '=', 'carts_detail.cart_id')
            ->join('products', 'carts_detail.product_id', '=', 'products.id')
            ->get();

        return $query;
    }
}
