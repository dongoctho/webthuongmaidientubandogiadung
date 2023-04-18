<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface ManufactureRepositoryInterface extends BaseRepositoryInterface
{
    public function getManufactureByCondition($condition, array $column = ['*']);
}
