<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface StorageRepositoryInterface extends BaseRepositoryInterface
{
    public function findProduct($product_id);
    public function getProductSale($condition, array $column = ['*']);
    public function getStorageByCondition($condition, array $column = ['*']);
    public function updateProductId($id, $attributes = []);
}
