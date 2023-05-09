<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\OrderDetail;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;
use App\Repositories\BaseRepository;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    public function getModel()
    {
        return OrderDetail::class;
    }

    public function findProduct($product_id)
    {
        return $this->model->where('product_id', $product_id)
                           ->whereNull('orders_detail.deleted_at')
                           ->join('orders', 'orders.id', '=', 'order_id')
                           ->first();
    }

    public function getAllOrder($userId)
    {
        $query = $this->model
            ->where('user_id', $userId)
            ->where('orders_detail.deleted_at', null)
            ->orderByDesc('orders_detail.id')
            ->join('orders', 'orders.id', '=', 'orders_detail.order_id')
            ->get();

        return $query;
    }

    public function getOrderDetail($userId, $id, array $column = ['*'])
    {
        $query = $this->model
            ->select($column)
            ->where('user_id', $userId)
            ->where('orders_detail.deleted_at', null)
            ->where('orders_detail.order_id', '=', $id)
            ->leftjoin('orders', 'orders.id', '=', 'orders_detail.order_id')
            ->leftjoin('products', 'orders_detail.product_id', '=', 'products.id')->get();

        return $query;
    }

    public function getOrderDetailByCondition($id, array $column = ['*'])
    {
        $query = $this->model
            ->select($column)
            ->where('orders_detail.deleted_at', null)
            ->where('orders_detail.order_id', '=', $id)
            ->leftjoin('orders', 'orders.id', '=', 'orders_detail.order_id')
            ->leftjoin('products', 'orders_detail.product_id', '=', 'products.id')->get();

        return $query;
    }
}
