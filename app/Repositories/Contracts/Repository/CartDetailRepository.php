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

    public function findProduct($product_id, $cart_id)
    {
        return $this->model
        ->where('carts_detail.product_id', $product_id)
        ->where('carts_detail.cart_id', $cart_id)
        ->where('carts_detail.deleted_at', '=', null)
        ->leftjoin('products', 'carts_detail.product_id', '=', 'products.id')
        ->first();
    }

    public function getDetailCart($userId, array $column = ['*'], array $condition = [])
    {
        $query = $this->model->select($column);

        $query->leftjoin('carts', 'carts_detail.cart_id', '=', 'carts.id')
              ->leftjoin('products', 'carts_detail.product_id', '=', 'products.id')
              ->leftjoin('storages', 'carts_detail.product_id', '=', 'storages.product_id');
        $query->where('user_id' , '=', $userId)
              ->whereNull('carts.deleted_at');

        if (isset($condition['product_id'])) {
            $query->where('carts_detail.product_id', '=', $condition['product_id']);
        }

        return $query->get();

    }

    public function getCartDetail($id)
    {
        $query = $this->model
            ->where('carts_detail.cart_id','=', $id)
            ->where('carts_detail.deleted_at', null)
            ->leftjoin('carts', 'carts.id', '=', 'carts_detail.cart_id')
            ->leftjoin('products', 'carts_detail.product_id', '=', 'products.id')
            ->get();

        return $query;
    }
}
