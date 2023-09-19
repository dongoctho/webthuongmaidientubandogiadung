<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getByCondition($condition, array $column = ['*']);
    public function getProductByCondition($condition, array $column = ['*']);
    public function findProduct($product_id);
    public function getProductByConditionAdmin($condition, array $column = ['*']);
    public function getProductByCategory($category_id, array $column = ['*']);
    public function getProduct();
    public function findIdProduct($product_id);
    public function countProduct();
}
