<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Http\Requests\CreateCategoryFormRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $userRepository;
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface,
                                UserRepositoryInterface $userRepositoryInterface)
    {
        $this->categoryRepository = $categoryRepositoryInterface;
        $this->userRepository = $userRepositoryInterface;
    }

    public function index()
    {
        return view('admin.category.add_category');
    }

    public function create(CreateCategoryFormRequest $request)
    {
        $data = $request->all();
        $this->categoryRepository->create($request->toArray());

        return response()->json([
            'name' => $data['name'],
            'code' => $data['code'],
        ], 201);
    }

    public function list()
    {
        $categories = $this->categoryRepository->getAll();

        return view('admin.category.list_category', [
            'categories' => $categories
        ]);

    }

    public function destroy(int $id)
    {
        $this->categoryRepository->delete($id);

        return redirect()->back();

    }

    public function show(int $id)
    {
        $categories = $this->categoryRepository->find($id);

        return view('admin.category.show_category', [
            'categories' => $categories
        ]);

    }

    public function update(int $id, CreateCategoryFormRequest $request)
    {
        $this->categoryRepository->update($id, $request->toArray());

        return redirect()->route('list_category');

    }

}
