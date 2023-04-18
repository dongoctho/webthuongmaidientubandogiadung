<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Arr;

interface CartRepositoryInterface extends BaseRepositoryInterface
{
    public function countProductInCart($userId);
    public function sellectCartDetail($userId);
    public function findUser($id);
    public function getCartByCondition($condition, array $column = ['*']);
}
