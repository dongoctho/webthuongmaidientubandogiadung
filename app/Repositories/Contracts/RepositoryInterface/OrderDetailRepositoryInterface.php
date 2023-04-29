<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface OrderDetailRepositoryInterface extends BaseRepositoryInterface
{
    public function findProduct($product_id);
    public function getAllOrder($userId);
    public function getOrderDetail($userId, $id, array $column = ['*']);
    public function getOrderDetailByCondition($id, array $column = ['*']);
}
