<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Order;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }

    public function findUser($id){
        return $this->model->where('user_id', $id)->first();
    }

    public function getOrderByCondition($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)
            ->where('orders.deleted_at', '=', null)
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->leftjoin('vouchers', 'orders.voucher_id', '=', 'vouchers.id')->get();

        if (isset($condition['key'])) {
            $query->where('users.name', 'like', '%'.$condition['key'].'%')
                  ->orWhere('users.phone', 'like', '%'.$condition['key'].'%')
            ->get();
        }

        return $query->paginate(6);
    }

    public function getAllOrder($userId)
    {
        $query = $this->model
            ->where('user_id', $userId)
            ->where('orders.deleted_at', null)
            ->orderByDesc('orders.id')
            ->get();

        return $query;
    }

}
