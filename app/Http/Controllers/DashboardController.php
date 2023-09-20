<?php

namespace App\Http\Controllers;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;

class DashboardController extends Controller
{
    protected $categoryRepository;
    protected $orderRepository;
    protected $productRepository;
    protected $userRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepositoryInterface,
        OrderRepositoryInterface $orderRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->categoryRepository = $categoryRepositoryInterface;
        $this->orderRepository = $orderRepositoryInterface;
        $this->productRepository = $productRepositoryInterface;
        $this->userRepository = $userRepositoryInterface;
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

        $status0 = $this->orderRepository->statusOrder("0")->toArray();
        $status1 = $this->orderRepository->statusOrder("1")->toArray();
        $status2 = $this->orderRepository->statusOrder("2")->toArray();
        $status3 = $this->orderRepository->statusOrder("3")->toArray();
        $status4 = $this->orderRepository->statusOrder("4")->toArray();

        $countproduct = $this->productRepository->countProduct()->toArray();

        $sumPrice = $this->orderRepository->sumPrice();

        $newUser = $this->userRepository->newUser();

        return view('admin.statistical', compact('newUser','sumPrice','countproduct','check_dashboard','sumSale1','sumSale2','sumSale3','sumSale4','sumSale5','sumSale6','sumSale7','sumSale8','sumSale9','sumSale10','sumSale11','sumSale12', 'status0', 'status1', 'status2', 'status3', 'status4'));
    }
}
