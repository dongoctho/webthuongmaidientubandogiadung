<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface CartDetailRepositoryInterface extends BaseRepositoryInterface
{
    public function findProduct($product_id);
    public function getDetailCart($userId, array $column = ['*']);
    public function getCartDetail($userId, $id);
}
