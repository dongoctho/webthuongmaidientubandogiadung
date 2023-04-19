<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Cart;
use App\Repositories\Contracts\RepositoryInterface\CartRepositoryInterface;
use App\Repositories\BaseRepository;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    public function getModel()
    {
        return Cart::class;
    }

    public function countProductInCart($userId)
    {
        $query = $this->model
            ->where('user_id', $userId)
            ->where('carts_detail.deleted_at', null)
            ->join('carts_detail', 'carts.id', '=', 'carts_detail.cart_id')->count();

        return $query;
    }

    public function sellectCartDetail($userId)
    {
        $query = $this->model
            ->where('user_id', $userId)
            ->where('carts_detail.deleted_at', null)
            ->join('carts_detail', 'carts.id', '=', 'carts_detail.cart_id')->get();

        return $query;
    }

    public function findUser($id){
        return $this->model->where('user_id', $id)->first();
    }

    public function getCartByCondition($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)
            ->where('carts.deleted_at', '=', null)
            ->leftjoin('users', 'carts.user_id', '=', 'users.id')->get();

        if (isset($condition['key'])) {
            $query->where('users.name', 'like', '%'.$condition['key'].'%')
            ->get();
        }

        return $query->paginate(6);
    }


}
