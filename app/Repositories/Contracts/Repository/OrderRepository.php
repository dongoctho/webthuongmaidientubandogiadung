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

    public function sumPrice()
    {
        $query = $this->model->newQuery();
        $query->selectRaw("SUM(orders.price) as sumPrice");

        return $query->get();
    }

    public function statusOrder($status)
    {
        $query = $this->model->newQuery();

        $query->selectRaw("COUNT(orders.status) as countStatus")
              ->whereRaw("orders.status = " . $status);

        return $query->get();
    }

    public function sumSale($month)
    {
        $query = $this->model->newQuery();

        $query->selectRaw("SUM(orders_detail.quantity) as sumSale")
              ->leftjoin("orders_detail", "orders.id", "=", "orders_detail.order_id")
              ->whereRaw("orders.status = 3")
              ->whereRaw("DATE_FORMAT(orders.updated_at,'%m') = '" . $month . "'");

        return $query->get();
    }

    public function findUser($id){
        return $this->model->where('user_id', $id)->first();
    }

    public function findOrder($id){
        return $this->model
            ->where('orders.id', $id)
            ->where('orders.deleted_at', '=', null)
            ->first();
    }

    public function getOrderByCondition($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)
            ->where('orders.deleted_at', '=', null)
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->orderByDesc('orders.id')
            ->leftjoin('vouchers', 'orders.voucher_id', '=', 'vouchers.id')->get();

        if (isset($condition['key'])) {
            $query->where('orders.name', 'like', '%'.$condition['key'].'%')
                  ->orWhere('orders.phone', 'like', '%'.$condition['key'].'%')
                  ->orWhere('orders.address', 'like', '%'.$condition['key'].'%')
            ->get();
        }

        return $query->paginate(6);
    }

    public function getAllOrder($userId)
    {
        $query = $this->model
            ->where('user_id', '=', $userId)
            ->whereNull('deleted_at')
            ->orderByDesc('id');

        return $query->paginate(8);
    }

}
