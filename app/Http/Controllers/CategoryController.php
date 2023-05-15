<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Http\Requests\CreateCategoryFormRequest;
use App\Http\Requests\EditCategoryFormRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $userRepository;
    protected $categoryRepository;

    public function __construct (
        CategoryRepositoryInterface $categoryRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->categoryRepository = $categoryRepositoryInterface;
        $this->userRepository = $userRepositoryInterface;
    }

    // show add category page
    public function index()
    {
        $check_category = true;
        return view('admin.category.add_category', compact('check_category'));
    }

    // create category to database
    public function create(CreateCategoryFormRequest $request)
    {
        $this->categoryRepository->create($request->toArray());

        return redirect()->route('list_category')->with('msg', 'Thành công');
    }

    // show list categories
    public function list(Request $request)
    {
        $check_category = true;
        $key = "";
        $data = [
            'key' => $request->key
        ];
        $key = $request->key;
        $categories = $this->categoryRepository->getCategoryByCondition($data);

        return view('admin.category.list_category', compact('categories', 'key', 'data', 'check_category'));
    }

    // delete category
    public function destroy(int $id)
    {
        $this->categoryRepository->delete($id);

        return redirect()->back();

    }

    // show information category
    public function show(int $id)
    {
        $check_category = true;
        $categories = $this->categoryRepository->find($id);

        return view('admin.category.show_category', compact('categories', 'check_category'));

    }

    // update information category
    public function update(int $id, EditCategoryFormRequest $request)
    {
        $this->categoryRepository->update($id, $request->toArray());

        return redirect()->route('list_category');
    }

}
