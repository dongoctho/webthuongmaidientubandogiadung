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

    public function getVoucherByCondition($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)->where('vouchers.deleted_at', '=', null)->get();

        if (isset($condition['key'])) {
            $query->where('name', 'like', '%'.$condition['key'].'%')
                  ->orwhere('code', 'like', '%'.$condition['key'].'%')
            ->get();
        }

        return $query->paginate(6);
    }

    public function getVoucherByConditionAdmin()
    {
        $query = $this->model->newQuery();
        $query->select(['*'])->where('vouchers.deleted_at', '=', null);

        return $query->get();
    }

    public function findVoucher($voucher_id)
    {
        return $this->model
        ->where('vouchers.id', $voucher_id)
        ->where('vouchers.deleted_at', '=', null)
        ->first();
    }
}
