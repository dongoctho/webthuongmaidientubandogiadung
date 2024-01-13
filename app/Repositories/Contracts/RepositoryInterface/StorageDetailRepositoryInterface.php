<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface StorageDetailRepositoryInterface extends BaseRepositoryInterface
{
    public function findStorage($storage_id);
    public function getStorageDetailByCondition($condition, array $column = ['*']);
}
