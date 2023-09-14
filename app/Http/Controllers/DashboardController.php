<?php

namespace App\Http\Controllers;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;

class DashboardController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->categoryRepository = $categoryRepositoryInterface;
    }

    // show dashboard page
    public function dashboard()
    {
        $check_dashboard = true;
        return view('admin.statistical', compact('check_dashboard'));
    }
}
