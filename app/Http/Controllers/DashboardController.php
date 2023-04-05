<?php

namespace App\Http\Controllers;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->categoryRepository = $categoryRepositoryInterface;
    }

    public function dashboard()
    {
        $categories = $this->categoryRepository->getAll();

        $user = auth()->user();

        if ($user) {
            return view('admin.category.list_category',[
                'user' => $user,
                'categories' => $categories
            ]);
        }
        else {
            return redirect()->route('login_page');
        }
    }
}
