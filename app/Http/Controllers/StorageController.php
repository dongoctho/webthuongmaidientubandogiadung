<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RepositoryInterface\StorageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Http\Requests\CreateStorageFormRequest;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    protected $storageRepository;
    protected $productRepository;

    public function __construct(StorageRepositoryInterface $storageRepositoryInterface,
    ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->storageRepository = $storageRepositoryInterface;
        $this->productRepository = $productRepositoryInterface;
    }

    public function index()
    {
        $products = $this->productRepository->getAll();

        return view('admin.storage.add_storage', [
            'products' => $products
        ]);
    }

    public function create(CreateStorageFormRequest $request)
    {
        $products = $this->productRepository->getAll();

        $data = [
            'code' => $request->code,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'product_id' => $request->product_id
        ];

        $this->storageRepository->create($data);

        return view('admin.storage.add_storage', [
            'products' => $products
        ])->with('msg', 'Created');
    }

    public function list()
    {
        $storages = $this->storageRepository->getAll();

        return view('admin.storage.list_storage', [
            'storages' => $storages
        ]);
    }

    public function destroy(int $id)
    {
        $this->storageRepository->delete($id);

        return redirect()->back();
    }

    public function show(int $id)
    {
        $products = $this->productRepository->getAll();
        $storages = $this->storageRepository->find($id);

        return view('admin.storage.show_storage', [
            'storages' => $storages,
            'products' => $products
        ]);
    }

    public function update(int $id, CreateStorageFormRequest $request)
    {
        $data = [
            'code' => $request->code,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'product_id' => $request->product_id
        ];

        $this->storageRepository->update($id, $data);

        return redirect()->route('list_storage');
    }
}
