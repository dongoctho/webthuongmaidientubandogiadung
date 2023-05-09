<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RepositoryInterface\StorageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;
use App\Http\Requests\CreateStorageFormRequest;
use App\Http\Requests\EditStorageFormRequest;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    protected $storageRepository;
    protected $productRepository;
    protected $orderDetailRepository;

    public function __construct(
        StorageRepositoryInterface $storageRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface,
        OrderDetailRepositoryInterface $orderDetailRepositoryInterface
    ) {
        $this->storageRepository = $storageRepositoryInterface;
        $this->productRepository = $productRepositoryInterface;
        $this->orderDetailRepository = $orderDetailRepositoryInterface;
    }

    // show storage page
    public function index()
    {
        $check_storage = true;
        $products = $this->productRepository->getAll();

        return view('admin.storage.add_storage', compact('products', 'check_storage'));
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
        $check_storage = true;
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
            'storages.product_id',
            'storages.created_at'
        ];
        $storages = $this->storageRepository->getStorageByCondition($data, $column);

        return view('admin.storage.list_storage', compact('storages', 'key', 'data', 'check_storage'));
    }

    // delete storage
    public function destroy(int $id, int $product_id)
    {
        $order = $this->orderDetailRepository->findProduct($product_id);
        if (isset($order)) {
            return redirect()->back()->with('msg','Không thể xóa vì sản phẩm đã được đặt');
        } else {
            $this->storageRepository->delete($id);
        }

        return redirect()->back();
    }

    // show information storage
    public function show(int $id)
    {
        $check_storage = true;
        $products = $this->productRepository->getAll();
        $storages = $this->storageRepository->find($id);

        return view('admin.storage.show_storage', compact('storages', 'products', 'check_storage'));
    }

    // update information storage
    public function update(int $id, EditStorageFormRequest $request)
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
