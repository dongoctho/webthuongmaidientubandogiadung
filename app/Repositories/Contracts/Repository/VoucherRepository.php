<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Voucher;
use App\Repositories\Contracts\RepositoryInterface\VoucherRepositoryInterface;
use App\Repositories\BaseRepository;

class VoucherRepository extends BaseRepository implements VoucherRepositoryInterface
{
    public function getModel()
    {
        return Voucher::class;
    }
}
