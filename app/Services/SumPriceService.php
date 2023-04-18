<?php

namespace App\Services;
use App\Repositories\Contracts\RepositoryInterface\CartDetailRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CartRepositoryInterface;

class SumPriceService
{
    protected $cartDetailRepository;

    public function __construct(CartDetailRepositoryInterface $cartDetailRepositoryInterface)
    {
        $this->cartDetailRepository = $cartDetailRepositoryInterface;
    }
    // sum price
    public function sumPrice($userId, $column)
    {
        $cartDetails = $this->cartDetailRepository->getDetailCart($userId, $column);
        $sum = 0;
        foreach ( $cartDetails as $item ) {
            $sum += $item->cart_price * $item->quantity;
        }

        return $sum;
    }
}
