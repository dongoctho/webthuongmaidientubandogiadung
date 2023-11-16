<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function findUser($id);
    public function getOrderByCondition($condition, array $column = ['*']);
    public function getAllOrder($userId);
    public function findOrder($id);
    public function sumSale($month, $year);
    public function statusOrder($status);
    public function sumPrice();
    public function sumSaleDay($yes);
    public function statusOrderDay($status, $yes);
}
