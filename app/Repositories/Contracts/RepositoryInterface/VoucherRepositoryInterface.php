<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface VoucherRepositoryInterface extends BaseRepositoryInterface
{
    public function getVoucherByCondition($condition, array $column = ['*']);
    public function getVoucherByConditionAdmin();
    public function findVoucher($voucher_id);
}
