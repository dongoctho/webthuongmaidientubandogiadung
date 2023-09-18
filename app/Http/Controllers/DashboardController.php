<?php

namespace App\Http\Controllers;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;

class DashboardController extends Controller
{
    protected $categoryRepository;
    protected $orderRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepositoryInterface,
        OrderRepositoryInterface $orderRepositoryInterface
    ) {
        $this->categoryRepository = $categoryRepositoryInterface;
        $this->orderRepository = $orderRepositoryInterface;
    }

    // show dashboard page
    public function dashboard()
    {
        $check_dashboard = true;
        $sumSale1 = $this->orderRepository->sumSale('01')->toArray();
        $sumSale2 = $this->orderRepository->sumSale('02')->toArray();
        $sumSale3 = $this->orderRepository->sumSale('03')->toArray();
        $sumSale4 = $this->orderRepository->sumSale('04')->toArray();
        $sumSale5 = $this->orderRepository->sumSale('05')->toArray();
        $sumSale6 = $this->orderRepository->sumSale('06')->toArray();
        $sumSale7 = $this->orderRepository->sumSale('07')->toArray();
        $sumSale8 = $this->orderRepository->sumSale('08')->toArray();
        $sumSale9 = $this->orderRepository->sumSale('09')->toArray();
        $sumSale10 = $this->orderRepository->sumSale('10')->toArray();
        $sumSale11 = $this->orderRepository->sumSale('11')->toArray();
        $sumSale12 = $this->orderRepository->sumSale('12')->toArray();

        return view('admin.statistical', compact('check_dashboard','sumSale1','sumSale2','sumSale3','sumSale4','sumSale5','sumSale6','sumSale7','sumSale8','sumSale9','sumSale10','sumSale11','sumSale12'));
    }
}
