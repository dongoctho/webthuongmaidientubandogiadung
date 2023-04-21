<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderFormRequest;
use App\Http\Requests\CreateOrderAdminFormRequest;
use App\Constants\OrderConstant;
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
use App\Repositories\Contracts\RepositoryInterface\CartDetailRepositoryInterface;
use App\Services\SumPriceService;
use Illuminate\Support\Facades\Request as FacadesRequest;

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
    protected $sum_price_service;

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
        OrderDetailRepositoryInterface $orderDetailRepositoryInterface,
        SumPriceService $sumPriceService
    ) {
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
        $this->sum_price_service = $sumPriceService;
    }

    // index add order admin
    public function addOrderAdmin()
    {
        $columnSelect = [
            'storages.id as storage_id',
            'products.id as product_id',
            'products.price',
            'products.name',
            'products.image',
        ];

        $products = $this->productRepository->getProductByConditionAdmin($columnSelect);
        $vouchers = $this->voucherRepository->getVoucherByConditionAdmin();

        return view('admin.order.add_order', compact('products', 'vouchers'));
    }

    // add order admin
    public function createOrderAdmin(CreateOrderAdminFormRequest $request)
    {
        $sumPrice = 0;
        $priceHandle = 0;
        $sumPriceVoucher = 0;
        $voucher = $this->voucherRepository->findVoucher($request->voucher_id);
        $product = $this->productRepository->findProduct($request->product_id);
        $user = auth()->user();

        if ( $product->product_type == 0 ) {
            $priceHandle = $product->price * (1 - ($product->discount / 100));
        } else if ( $product->product_type == 1 ) {
            $priceHandle = $product->price - $product->discount;
        }

        $sumPrice = $priceHandle * $request->quantity;

        if ( $request->voucher_id == null ) {
            $sumPriceVoucher = $sumPrice;
        } else {
            if ( $voucher->voucher_type == 0 ) {
                $sumPriceVoucher = $sumPrice * (1 - ($voucher->discount / 100));
            } else if ( $voucher->voucher_type == 1 ) {
                $sumPriceVoucher = $sumPrice - $voucher->discount;
                if ( $sumPriceVoucher < 0) {
                    $sumPriceVoucher = 0;
                }
            }
        }

        $dataUser = [
            'user_id' => $user->id,
            'voucher_id' => $request->voucher_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->homenumber.'-'.$request->ward.'-'.$request->city.'-'.$request->country,
            'price' => $sumPriceVoucher,
            'status' => 0
        ];

        $orderId = $this->orderRepository->create($dataUser);

        $data = [
            'order_id' => $orderId->id,
            'product_id' => $request->product_id,
            'price' => $priceHandle,
            'quantity' => $request->quantity,
            'image' => $product->image
        ];

        $storage = $this->storageRepository->findProduct($request->product_id);

        $quantity = [
            'quantity' => $storage->quantity - $request->quantity,
            'description' => $storage->quantity - $request->quantity
        ];

        $this->storageRepository->updateProductId($request->product_id, $quantity);
        $this->orderDetailRepository->create($data);
        $this->productRepository->update($request->product_id, ['sale' => $product->product_sale + $request->quantity]);
        if (isset($voucher)) {
            $this->voucherRepository->update($voucher->id, ['quantity' => $voucher->quantity - 1]);
        }

        return redirect()->route('list_order');
    }

    // show order page
    public function index(Request $request)
    {
        $priceHandle = 0;
        $sumPrice = 0;
        $quantity = 0;
        $user = auth()->user();
        $params = $request->all();
        $product_id = $request->productId;
        $columnSelect = [
            'carts.id as cart_id',
            'carts_detail.price as cart_price',
            'carts_detail.quantity',
            'carts_detail.image',
            'products.name as product_name',
            'products.id as product_id'
        ];
        $idUserCart = $this->cartRepository->findUser($user->id);
        $cartDetail = $this->cartDetailRepository->findProduct($request->productId, $idUserCart->id);

        if (empty($cartDetail)) {
            $quantity = 1;
        } else {
            $quantity = 1 + $cartDetail->quantity;
        }

        $condition = [];

        if (isset($params['productId'])){
            $product = $this->productRepository->find($params['productId']);

            if ( $product->product_type == 0 ) {
                $priceHandle = $product->price * (1 - ($product->discount / 100));
            } else if ( $product->product_type == 1 ) {
                $priceHandle = $product->price - $product->discount;
            }
            if (isset($idUserCart)) {

                if ( $cartDetail == null ) {

                    $data = [
                        'cart_id' => $idUserCart->id,
                        'product_id' => $params['productId'],
                        'price' => $priceHandle,
                        'quantity' => $quantity,
                        'image' => $product->image
                    ];

                    $this->cartDetailRepository->create($data);
                } else if ( $params['productId'] == $cartDetail->product_id ) {

                    $dataCart = [
                        'quantity' => $quantity,
                    ];

                    $this->cartDetailRepository->update($cartDetail->id, $dataCart);
                }

            } else {
                $dataUser = [
                    'user_id' => $user->id
                ];
                $cartId = $this->cartRepository->create($dataUser);

                $data = [
                    'cart_id' => $cartId->id,
                    'product_id' => $params['productId'],
                    'price' => $priceHandle,
                    'quantity' => $quantity,
                    'image' => $product->image
                ];

                $this->cartDetailRepository->create($data);

            }
            $condition['product_id'] = $params['productId'];
        }

        $cartDetails = $this->cartDetailRepository->getDetailCart($user->id, $columnSelect, $condition);
        $vouchers = $this->voucherRepository->getAll();

        foreach ($cartDetails as $cartDetail) {
            $sumPrice += $cartDetail->cart_price * $cartDetail->quantity;
        }

        if ( isset($user) ) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.checkout', compact('count', 'cartDetails', 'vouchers', 'sumPrice','product_id'));
    }

    // add cartDetail to order
    public function addOrder(CreateOrderFormRequest $request)
    {
        $user = auth()->user();
        $priceHandle = 0;
        $sumPrice = 0;
        $quantity = 0;
        $voucher_id = explode("-", $request->voucher_id);
        $voucher = $this->voucherRepository->find($voucher_id[2]);

        if (empty($cartDetail)) {
            $quantity = 1;
        } else {
            $quantity = 1 + $cartDetail->quantity;
        }

        if (isset($request->product_id)) {
            $idUserCart = $this->cartRepository->findUser($user->id);
            $cartDetail = $this->cartDetailRepository->findProduct($request->product_id, $idUserCart->id);

            $sumPrice = $cartDetail->price * $cartDetail->quantity;

            if ( $voucher == null ) {
                $priceHandle = $sumPrice;
            } else {
                if ( $voucher->voucher_type == 0 ) {
                    $priceHandle = $sumPrice * (1 - ($voucher->discount / 100));
                } else if ( $voucher->voucher_type == 1 ) {
                    $priceHandle = $sumPrice - $voucher->discount;
                    if ( $priceHandle < 0) {
                        $priceHandle = 0;
                    }
                }
            }

            $dataUser = [
                'user_id' => $user->id,
                'voucher_id' => $voucher->id,
                'name' => $user->name,
                'phone' => $request->phone,
                'address' => $request->homenumber.'-'.$request->ward.'-'.$request->city.'-'.$request->country,
                'price' => $priceHandle,
                'status' => 0
            ];

            $orderId = $this->orderRepository->create($dataUser);

            $data = [
                'order_id' => $orderId->id,
                'product_id' => $request->product_id,
                'price' => $cartDetail->price,
                'quantity' => $cartDetail->quantity,
                'image' => $cartDetail->image
            ];

            $storage = $this->storageRepository->findProduct($cartDetail->product_id);

            $quantity = [
                'quantity' => $storage->quantity - $cartDetail->quantity,
                'description' => $storage->quantity - $cartDetail->quantity
            ];

            $this->storageRepository->updateProductId($cartDetail->product_id, $quantity);
            $this->orderDetailRepository->create($data);
            $this->productRepository->update($cartDetail->product_id, ['sale' => $cartDetail->product_sale + $cartDetail->quantity]);
            if (isset($voucher)) {
                $this->voucherRepository->update($voucher->id, ['quantity' => $voucher->quantity - 1]);
            }

            return redirect()->route('infor_order')->with('msg', 'Mua Hàng Thành Công');
        } else {
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
            $sumPrice = $this->sum_price_service->sumPrice($user->id, $columnSelect);

            $priceHandle = 0;
            if ( $voucher == null ) {
                $priceHandle = $sumPrice;
            } else if ( $voucher->voucher_type == 0 ) {
                $priceHandle = $sumPrice * (1 - ($voucher->discount / 100));
            } else if ( $voucher->voucher_type == 1 ) {
                $priceHandle = $sumPrice - $voucher->discount;
                if ( $priceHandle < 0) {
                    $priceHandle = 0;
                }
            }

            $dataUser = [
                'user_id' => $user->id,
                'voucher_id' => $voucher->id,
                'name' => $user->name,
                'phone' => $request->phone,
                'address' => $request->homenumber.'-'.$request->ward.'-'.$request->city.'-'.$request->country,
                'price' => $priceHandle,
                'status' => 0
            ];

            $orderId = $this->orderRepository->create($dataUser);

            foreach ( $cartDetails as $cartDetail ) {
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
                    'description' => $storage->quantity - $cartDetail->quantity
                ];

                $this->storageRepository->updateProductId($cartDetail->product_id, $quantity);
                $this->orderDetailRepository->create($data);
                $this->cartDetailRepository->delete($cartDetail->cart_detail_id);
                $this->productRepository->update($cartDetail->product_id, ['sale' => $cartDetail->product_sale + $cartDetail->quantity]);
                $this->voucherRepository->update($voucher->id, ['quantity' => $voucher->quantity - 1]);
            }

            return redirect()->route('infor_order')->with('msg', 'Mua Hàng Thành Công');
        }


    }

    // show list order client
    public function inforOrder()
    {
        $user = auth()->user();
        $orders = $this->orderRepository->getAllOrder($user->id);

        if ( isset($user) ) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.infor_order', compact('orders', 'count'));
    }

    // show list order detail client
    public function inforOrderDetail(int $id_user, int $id)
    {
        $user = auth()->user();
        $column = [
            'orders_detail.order_id',
            'orders_detail.id',
            'orders_detail.order_id',
            'orders_detail.product_id',
            'orders_detail.price',
            'orders_detail.quantity',
            'orders_detail.image',
            'products.name',
            'orders_detail.created_at'
        ];
        $order_details = $this->orderDetailRepository->getOrderDetail($id_user, $id, $column);

        if ( isset($user) ) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.show_order_detail', compact('order_details', 'count'));
    }

    // show list order admin
    public function list(Request $request)
    {
        $key = "";
        $data = [
            'key' => $request->key
        ];
        $key = $request->key;
        $column = [
            'orders.id',
            'users.id  as user_id',
            'vouchers.name as voucher_name',
            'users.name as user_name',
            'orders.phone',
            'orders.name',
            'orders.address',
            'orders.price',
            'orders.status',
            'orders.created_at'
        ];
        $orders = $this->orderRepository->getOrderByCondition($data, $column);

        return view('admin.order.list_order', compact('orders', 'key'));
    }

    // show information order admin
    public function show(int $id)
    {
        $order = $this->orderRepository->find($id);

        return view('admin.order.show_order', compact('order'));
    }

    // update status order admin
    public function update(Request $request)
    {
        $check = false;
        $data = $request->all();
        if ($data['oldStatus'] == OrderConstant::WAIT_CONFIRM) {
            if ($data['status'] == OrderConstant::DELIVERED) {
                $check;
            } else if ($data['status'] == OrderConstant::RECEIVED) {
                $check;
            } else {
                $check = true;
            }
        } else if ($data['oldStatus'] == OrderConstant::CONFIRMED) {
            if ($data['status'] == OrderConstant::WAIT_CONFIRM) {
                $check;
            } else if ($data['status'] == OrderConstant::RECEIVED) {
                $check;
            } else if ($data['status'] == OrderConstant::UNSUCCESSFUL) {
                $check;
            } else {
                $check = true;
            }
        } else if ($data['oldStatus'] == OrderConstant::DELIVERED) {
            if ($data['status'] == OrderConstant::WAIT_CONFIRM) {
                $check;
            } else if ($data['status'] == OrderConstant::CONFIRMED) {
                $check;
            } else if ($data['status'] == OrderConstant::UNSUCCESSFUL) {
                $check;
            } else {
                $check = true;
            }
        } else if ($data['oldStatus'] == OrderConstant::RECEIVED) {
            if ($data['status'] == OrderConstant::WAIT_CONFIRM) {
                $check;
            } else if ($data['status'] == OrderConstant::CONFIRMED) {
                $check;
            } else if ($data['status'] == OrderConstant::DELIVERED) {
                $check;
            } else if ($data['status'] == OrderConstant::RECEIVED) {
                $check;
            } else {
                $check = true;
            }
        }

        if ($check == false) {
            return response()->json([
                'error' => $data['status'],
            ], 200);
        } else {
            $result = $this->orderRepository->update( $data['id'], ['status' => $data['status']]);
            if ( $result != false ) {
                return response()->json([
                    'success' => $data['status'],
                ], 201);
            }
        }
    }

    // show list order detail admin
    public function listOrderDetail(int $id_user, int $id, Request $request)
    {
        $sumPrice = 0;
        $column = [
            'orders_detail.order_id',
            'orders_detail.id',
            'orders_detail.order_id',
            'orders_detail.product_id',
            'orders_detail.price',
            'orders_detail.product_type',
            'orders_detail.discount',
            'orders_detail.quantity',
            'orders_detail.image',
            'products.name',
            'orders_detail.created_at'
        ];
        $order_details = $this->orderDetailRepository->getOrderDetail($id_user, $id, $column);

        foreach ($order_details as $order_detail) {
            if ( $order_detail->product_type == 0 ) {
                $priceHandle = $order_detail->price * (1 - ($order_detail->discount / 100));
            } else if ( $order_detail->product_type == 1 ) {
                $priceHandle = $order_detail->price - $order_detail->discount;
            }
            $sumPrice += $order_detail->quantity * $priceHandle;
        }

        return view('admin.order.list_order_detail', compact('order_details', 'sumPrice'));
    }
}
