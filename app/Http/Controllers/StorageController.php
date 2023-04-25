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

    public function __construct(
        StorageRepositoryInterface $storageRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface
    ) {
        $this->storageRepository = $storageRepositoryInterface;
        $this->productRepository = $productRepositoryInterface;
    }

    // show storage page
    public function index()
    {
        $products = $this->productRepository->getAll();

        return view('admin.storage.add_storage', compact('products'));
    }

    // create storage to database
    public function create(CreateStorageFormRequest $request)
    {
        $data = [
            'code' => $request->code,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'product_id' => $request->product_id
        ];

        $this->storageRepository->create($data);

        return redirect()->route('list_storage')->with('msg', 'Created');
    }

    // show list storage
    public function list(Request $request)
    {
        $key = "";
        $data = [
            'key' => $request->key
        ];

        $key = $request->key;

        $column = [
            'storages.quantity',
            'storages.id as id',
            'storages.description',
            'products.name',
            'storages.created_at'
        ];
        $storages = $this->storageRepository->getStorageByCondition($data, $column);

        return view('admin.storage.list_storage', compact('storages', 'key', 'data'));
    }

    // delete storage
    public function destroy(int $id)
    {
        $this->storageRepository->delete($id);

        return redirect()->back();
    }

    // show information storage
    public function show(int $id)
    {
        $products = $this->productRepository->getAll();
        $storages = $this->storageRepository->find($id);

        return view('admin.storage.show_storage', compact('storages', 'products'));
    }

    // update information storage
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
