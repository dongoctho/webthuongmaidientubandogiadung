<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RepositoryInterface\StorageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;
use App\Http\Requests\CreateStorageFormRequest;
use App\Http\Requests\EditStorageFormRequest;
use Illuminate\Http\Request;
use App\Models\Product;

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
    public function index(Request $request)
    {
        $products = $this->productRepository->getProduct();
        foreach ($products as $product) {
            $data[] = $product->name . '.' . $product->id;
        }

        return view('admin.storage.add_storage', compact('products', 'data'));
    }

    // create storage to database
    public function create(CreateStorageFormRequest $request)
    {
        $msg = "";
        $arrayProduct = explode(".", $request->product_id);
        $product = $this->productRepository->findProduct($arrayProduct[1]);
        if (isset($product)) {
            $storageCheck = $this->storageRepository->findProduct($arrayProduct[1]);
            if (isset($storageCheck)) {
                $msg = "Sản phẩm đã có trong kho";
            } else {
                $data = [
                    'code' => $request->code,
                    'quantity' => $request->quantity,
                    'description' => $request->description,
                    'product_id' => $product->id
                ];
                $this->storageRepository->create($data);
                $msg = "Thành công";
            }
        } else {
            $msg = "Sản phẩm không tồn tại";
        }

        return redirect()->route('list_storage')->with('msg', $msg);
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

        return view('admin.storage.list_storage', compact('check_storage','storages', 'key', 'data'));
    }

    // delete storage
    public function destroy(int $id, int $product_id)
    {
        $msg = "";
        $order = $this->orderDetailRepository->findProduct($product_id);
        if (isset($order)) {
            $msg = "Không thể xóa vì sản phẩm đã được đặt";
        } else {
            $this->storageRepository->delete($id);
        }

        return redirect()->back()->with('msg', $msg);
    }

    // show information storage
    public function show(int $id)
    {
        $products = $this->productRepository->getAll();
        $storages = $this->storageRepository->find($id);

        return view('admin.storage.show_storage', compact('storages', 'products'));
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
