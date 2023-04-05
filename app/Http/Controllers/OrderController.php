<?php

namespace App\Http\Controllers;

use App\Models\CartDetail;
use App\Repositories\Contracts\RepositoryInterface\CartDetailRepositoryInterface;
use App\Http\Requests\CreateOrderFormRequest;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ManufactureRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\StorageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CartRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\VoucherRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;

class OrderController extends Controller
{
    protected $userRepository;
    protected $productRepository;
    protected $storageRepository;
    protected $categoryRepository;
    protected $manufactureRepository;
    protected $cartRepository;
    protected $voucherRepository;
    protected $cartDetailRepository;
    protected $orderRepository;
    protected $orderDetailRepository;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface,
        StorageRepositoryInterface $storageRepositoryInterface,
        CategoryRepositoryInterface $categoryRepositoryInterface,
        ManufactureRepositoryInterface $manufactureRepositoryInterface,
        CartRepositoryInterface $cartRepositoryInterface,
        VoucherRepositoryInterface $voucherRepositoryInterface,
        CartDetailRepositoryInterface $cartDetailRepositoryInterface,
        OrderRepositoryInterface $orderRepositoryInterface,
        OrderDetailRepositoryInterface $orderDetailRepositoryInterface
    ){
        $this->userRepository = $userRepositoryInterface;
        $this->productRepository = $productRepositoryInterface;
        $this->storageRepository = $storageRepositoryInterface;
        $this->categoryRepository = $categoryRepositoryInterface;
        $this->manufactureRepository = $manufactureRepositoryInterface;
        $this->cartRepository = $cartRepositoryInterface;
        $this->voucherRepository = $voucherRepositoryInterface;
        $this->cartDetailRepository = $cartDetailRepositoryInterface;
        $this->orderRepository = $orderRepositoryInterface;
        $this->orderDetailRepository = $orderDetailRepositoryInterface;
    }

    public function index()
    {
        $user = auth()->user();

        $columnSelect = [
            'carts.id as cart_id',
            'carts_detail.price as cart_price',
            'carts_detail.quantity',
            'carts_detail.image',
            'products.name as product_name',
            'products.id as product_id'
        ];
        $cartDetails = $this->cartDetailRepository->getDetailCart($user->id, $columnSelect);
        $vouchers = $this->voucherRepository->getAll();

        $sumPrice = 0;

        foreach ($cartDetails as $item) {
            $sumPrice += $item->cart_price * $item->quantity;
        }

        if (isset($user)) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.checkout', [
            'count' => $count,
            'cartDetails' => $cartDetails,
            'vouchers'  => $vouchers,
            'sumPrice' => $sumPrice
        ]);
    }

    public function addOrder(CreateOrderFormRequest $request)
    {
        $user = auth()->user();
        $columnSelect = [
            'carts.id as cart_id',
            'carts_detail.price as cart_price',
            'carts_detail.quantity',
            'carts_detail.image',
            'carts_detail.id as cart_detail_id',
            'products.name as product_name',
            'products.id as product_id',
            'products.sale as product_sale'
        ];

        $cartDetails = $this->cartDetailRepository->getDetailCart($user->id, $columnSelect);
        $voucher_id = explode("-", $request->voucher_id);
        $voucher = $this->voucherRepository->find($voucher_id[2]);
        $sum = 0;
        $priceHandle = 0;


        foreach ($cartDetails as $cartDetail) {
            $sum += $cartDetail->cart_price * $cartDetail->quantity;
        }
        if ($voucher == null) {
            $priceHandle = $sum;
        } else if ($voucher->voucher_type == 0) {
            $priceHandle = $sum * (1 - ($voucher->discount / 100));
        } else if ($voucher->voucher_type == 1) {
            $priceHandle = $sum - $voucher->discount;
        }

        $dataUser = [
            'user_id' => $user->id,
            'voucher_id' => $voucher->id,
            'name' => $user->name,
            'phone' => $request->phone,
            'address' => $request->homenumber.''.$request->ward.''.$request->city.''.$request->country,
            'price' => $priceHandle,
            'status' => 0
        ];
        $orderId = $this->orderRepository->create($dataUser);

        foreach ($cartDetails as $cartDetail) {
            $data = [
                'order_id' => $orderId->id,
                'product_id' => $cartDetail->product_id,
                'price' => $cartDetail->cart_price,
                'quantity' => $cartDetail->quantity,
                'image' => $cartDetail->image
            ];
            $storage = $this->storageRepository->findProduct($cartDetail->product_id);
            $quantity = [
                'quantity' => $storage->quantity - $cartDetail->quantity,
                'description' => $storage->quantity - $cartDetail->quantity.' cái'
            ];
            $this->storageRepository->updateProductId($cartDetail->product_id, $quantity);
            $this->orderDetailRepository->create($data);
            $this->cartDetailRepository->delete($cartDetail->cart_detail_id);
            $this->productRepository->update($cartDetail->product_id, ['sale' => $cartDetail->quantity]);
            $this->voucherRepository->update($voucher->id, ['quantity' => $voucher->quantity - 1]);
        }

        return redirect()->route('infor_order')->with('msg', 'Mua Hàng Thành Công');
    }

    public function inforOrder()
    {
        $user = auth()->user();
        $orders = $this->orderDetailRepository->getAllOrder($user->id);

        if (isset($user)) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.infor_order', compact('orders', 'count'));
    }

    public function list()
    {
        $orders = $this->orderRepository->getAll();

        return view('admin.order.list_order', compact('orders'));
    }

    public function show(int $id)
    {
        $order = $this->orderRepository->find($id);

        return view('admin.order.show_order', compact('order'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $result = $this->orderRepository->update( $data['id'], ['status' => $data['status']]);
        if ($result != false) {
            return response()->json([
                'success' => $data['status'],
            ], 201);
        }

        return response()->json([
            'error' => $data['status'],
        ], 500);
    }

    public function listOrderDetail(int $id_user, int $id)
    {
        $order_details = $this->orderDetailRepository->getOrderDetail($id_user, $id);

        return view('admin.order.list_order_detail', compact('order_details'));
    }
}
