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
use Stripe\StripeClient;
use Stripe\PaymentIntent;
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

    public function addOderOnline($priceHandle, $voucher_id, $name, $phone, $address, $product_id)
    {
        $user = auth()->user();
        $productPrice = 0;
        $sumPrice = 0;

        if ( $product_id != 0 ) {
            $idUserCart = $this->cartRepository->findUser($user->id);
            $cartDetail = $this->cartDetailRepository->findProduct($product_id, $idUserCart->id);

            if ( $cartDetail->product_type == 0 ) {
                $productPrice = $cartDetail->price * (1 - ($cartDetail->discount / 100));
            } else if ( $cartDetail->product_type == 1 ) {
                $productPrice = $cartDetail->price - $cartDetail->discount;
            }

            $sumPrice = $productPrice * $cartDetail->quantity;

            if ( $voucher_id == 0 ) {
                $priceHandle = $sumPrice;
                $dataUser = [
                    'user_id' => $user->id,
                    'voucher_id' => null,
                    'name' => $name,
                    'phone' => $phone,
                    'address' => $address,
                    'price' => $priceHandle,
                    'status' => 0
                ];
            } else {
                $voucher = $this->voucherRepository->find($voucher_id);
                if ( $voucher->voucher_type == 0 ) {
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
                    'name' => $name,
                    'phone' => $phone,
                    'address' => $address,
                    'price' => $priceHandle,
                    'status' => 0
                ];
            }

            $orderId = $this->orderRepository->create($dataUser);

            $data = [
                'order_id' => $orderId->id,
                'product_id' => $product_id,
                'price' => $productPrice,
                'quantity' => $cartDetail->quantity,
                'image' => $cartDetail->image
            ];

            $this->orderDetailRepository->create($data);
        } else {
            $columnSelect = [
                'carts.id as cart_id',
                'products.price as price',
                'carts_detail.quantity',
                'carts_detail.image',
                'carts_detail.id as cart_detail_id',
                'products.name as product_name',
                'products.id as product_id',
                'products.sale as product_sale',
                'products.discount',
                'products.product_type'
            ];

            $cartDetails = $this->cartDetailRepository->getDetailCart($user->id, $columnSelect);

            if ($voucher_id == 0) {
                $dataUser = [
                    'user_id' => $user->id,
                    'voucher_id' => null,
                    'name' => $name,
                    'phone' => $phone,
                    'address' => $address,
                    'price' => $priceHandle,
                    'status' => 0
                ];
            } else {
                $voucher = $this->voucherRepository->find($voucher_id);

                $dataUser = [
                    'user_id' => $user->id,
                    'voucher_id' => $voucher->id,
                    'name' => $name,
                    'phone' => $phone,
                    'address' => $address,
                    'price' => $priceHandle,
                    'status' => 0
                ];
            }

            $orderId = $this->orderRepository->create($dataUser);

            foreach ( $cartDetails as $cartDetail ) {
                if ( $cartDetail->product_type == 0 ) {
                    $productPrice = $cartDetail->price * (1 - ($cartDetail->discount / 100));
                } else if ( $cartDetail->product_type == 1 ) {
                    $productPrice = $cartDetail->price - $cartDetail->discount;
                }
                $data = [
                    'order_id' => $orderId->id,
                    'product_id' => $cartDetail->product_id,
                    'price' => $productPrice,
                    'quantity' => $cartDetail->quantity,
                    'image' => $cartDetail->image
                ];

                $this->orderDetailRepository->create($data);
            }
        }

        return redirect()->route('infor_order')->with('msg', 'Mua Hàng Thành Công');
    }

    public function indexCheckoutOnline()
    {
        return view('client.payment_online');
    }

    // index add order admin
    public function addOrderAdmin()
    {
        $products = $this->productRepository->getProduct();
        foreach ($products as $product) {
            $data[] = $product->name . '.' . $product->id;
        }
        $vouchers = $this->voucherRepository->getVoucherByConditionAdmin();

        return view('admin.order.add_order', compact('products', 'vouchers', 'data'));
    }

    // add order admin
    public function createOrderAdmin(CreateOrderAdminFormRequest $request)
    {
        $arrayProduct = explode('.', $request->product_id);
        $msg = "";
        $sumPrice = 0;
        $priceHandle = 0;
        $user = auth()->user();
        $sumPriceVoucher = 0;
        if (empty($arrayProduct[1])) {
            $msg = "Sản phẩm không tồn tại";
        } else {
            $product = $this->productRepository->findProduct($arrayProduct[1]);
            if (isset($product)) {
                if ( $product->product_type == 0 ) {
                    $priceHandle = $product->price * (1 - ($product->discount / 100));
                } else if ( $product->product_type == 1 ) {
                    $priceHandle = $product->price - $product->discount;
                }

                $sumPrice = $priceHandle * $request->quantity;

                if (isset($request->voucher_id)) {
                    $voucher = $this->voucherRepository->findVoucher($request->voucher_id);

                    if ( $voucher->voucher_type == 0 ) {
                        $sumPriceVoucher = $sumPrice * (1 - ($voucher->discount / 100));
                    } else if ( $voucher->voucher_type == 1 ) {
                        $sumPriceVoucher = $sumPrice - $voucher->discount;
                        if ( $sumPriceVoucher < 0) {
                            $sumPriceVoucher = 0;
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
                } else {
                    $sumPriceVoucher = $sumPrice;
                    $dataUser = [
                        'user_id' => $user->id,
                        'voucher_id' => null,
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'address' => $request->homenumber.'-'.$request->ward.'-'.$request->city.'-'.$request->country,
                        'price' => $sumPriceVoucher,
                        'status' => 0
                    ];
                }

                $orderId = $this->orderRepository->create($dataUser);

                $data = [
                    'order_id' => $orderId->id,
                    'product_id' => $request->product_id,
                    'price' => $priceHandle,
                    'quantity' => $request->quantity,
                    'image' => $product->image
                ];

                $this->orderDetailRepository->create($data);
                $msg = "Thành công";
            } else {
                $msg = "Sản phẩm không tồn tại";
            }
        }

        return redirect()->route('list_order')->with('msg', $msg);
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

        $idUserCart = $this->cartRepository->findUser($user->id);
        $storage = $this->storageRepository->findProduct($product_id);
        $quantity = $request->quantity;
        $condition = [];

        if (isset($params['productId'])){
            $product = $this->productRepository->find($params['productId']);

            if ( $product->product_type == 0 ) {
                $priceHandle = $product->price * (1 - ($product->discount / 100));
            } else if ( $product->product_type == 1 ) {
                $priceHandle = $product->price - $product->discount;
            }

            if (isset($idUserCart)) {

                $cartDetail = $this->cartDetailRepository->findProduct($request->productId, $idUserCart->id);
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
        $columnSelect = [
            'carts.id as cart_id',
            'products.price as cart_price',
            'carts_detail.quantity',
            'carts_detail.image',
            'products.name as product_name',
            'products.id as product_id',
            'products.discount',
            'products.product_type'
        ];

        $cartDetails = $this->cartDetailRepository->getDetailCart($user->id, $columnSelect, $condition);
        $vouchers = $this->voucherRepository->getVoucherByConditionAdmin();

        foreach ($cartDetails as $cartDetail) {
            if ( $cartDetail->product_type == 0 ) {
                $priceHandle = $cartDetail->cart_price * (1 - ($cartDetail->discount / 100));
            } else if ( $cartDetail->product_type == 1 ) {
                $priceHandle = $cartDetail->cart_price - $cartDetail->discount;
            }
            $sumPrice += $priceHandle * $cartDetail->quantity;
        }

        if ( isset($user) ) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.checkout', compact('count', 'cartDetails', 'vouchers', 'sumPrice','product_id'));
    }

    public function addReOrder(int $id, CreateOrderFormRequest $request)
    {
        $sumPrice = 0;
        $priceHandle = 0;
        $productPrice = 0;
        $user = auth()->user();
        $column = [
            'orders_detail.order_id',
            'orders_detail.id',
            'orders_detail.order_id',
            'orders_detail.product_id',
            'products.price',
            'orders_detail.quantity',
            'orders_detail.image',
            'products.name',
            'products.discount',
            'products.product_type',
            'orders_detail.created_at'
        ];
        $order_details = $this->orderDetailRepository->getOrderDetail($user->id, $id, $column);
        $order = $this->orderRepository->findOrder($id);

        foreach ($order_details as $cartDetail) {
            if ( $cartDetail->product_type == 0 ) {
                $productPrice = $cartDetail->price * (1 - ($cartDetail->discount / 100));
            } else if ( $cartDetail->product_type == 1 ) {
                $productPrice = $cartDetail->price - $cartDetail->discount;
            }
            $sumPrice += $productPrice * $cartDetail->quantity;
        }

        $voucher_id = explode("-", $request->voucher_id);

        if ( $voucher_id['2'] == "" ) {

            $priceHandle = $sumPrice;
            $dataUser = [
                'user_id' => $user->id,
                'voucher_id' => null,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->homenumber.'-'.$request->ward.'-'.$request->city.'-'.$request->country,
                'price' => $priceHandle,
                'status' => 0
            ];
        } else {

            $voucher = $this->voucherRepository->find($voucher_id[2]);
            if ($voucher->voucher_type == 0) {
                $priceHandle = $sumPrice * (1 - ($voucher->discount / 100));
            } else if ($voucher->voucher_type == 1) {
                $priceHandle = $sumPrice - $voucher->discount;
                if ($priceHandle < 0) {
                    $priceHandle = 0;
                }
            }
            $dataUser = [
                'user_id' => $user->id,
                'voucher_id' => $voucher->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->homenumber.'-'.$request->ward.'-'.$request->city.'-'.$request->country,
                'price' => $priceHandle,
                'status' => 0
            ];
        }

        $orderId = $this->orderRepository->create($dataUser);

        foreach ( $order_details as $cartDetail ) {
            if ( $cartDetail->product_type == 0 ) {
                $productPrice = $cartDetail->price * (1 - ($cartDetail->discount / 100));
            } else if ( $cartDetail->product_type == 1 ) {
                $productPrice = $cartDetail->price - $cartDetail->discount;
            }
            $data = [
                'order_id' => $orderId->id,
                'product_id' => $cartDetail->product_id,
                'price' => $productPrice,
                'quantity' => $cartDetail->quantity,
                'image' => $cartDetail->image
            ];

            $this->orderDetailRepository->create($data);

        }

        return redirect()->route('infor_order')->with('msg', 'Mua Hàng Thành Công');
    }

    // add cartDetail to order
    public function addOrder(CreateOrderFormRequest $request)
    {
        switch ($request->input('action')) {
            case 'online':
                $user = auth()->user();
                $priceHandle = 0;
                $productPrice = 0;
                $sumPrice = 0;
                $voucher_id_check = 0;
                $product_id = 0;
                $voucher_id = explode("-", $request->voucher_id);
                if ($voucher_id[2] != "") {
                    $voucher_id_check = $voucher_id[2];
                }
                if (isset($request->product_id)) {
                    $product_id = $request->product_id;
                }

                $columnSelect = [
                    'carts.id as cart_id',
                    'products.price as price',
                    'carts_detail.quantity',
                    'carts_detail.image',
                    'carts_detail.id as cart_detail_id',
                    'products.name as product_name',
                    'products.id as product_id',
                    'products.sale as product_sale',
                    'products.discount',
                    'products.product_type'
                ];

                $cartDetails = $this->cartDetailRepository->getDetailCart($user->id, $columnSelect);
                $idUserCart = $this->cartRepository->findUser($user->id);

                foreach ($cartDetails as $cartDetail) {
                    if ( $cartDetail->product_type == 0 ) {
                        $productPrice = $cartDetail->price * (1 - ($cartDetail->discount / 100));
                    } else if ( $cartDetail->product_type == 1 ) {
                        $productPrice = $cartDetail->price - $cartDetail->discount;
                    }
                    $sumPrice += $productPrice * $cartDetail->quantity;
                }

                $priceHandle = 0;
                    if ( $voucher_id['2'] == "" ) {
                        $priceHandle = $sumPrice;
                    } else {
                        $voucher = $this->voucherRepository->find($voucher_id[2]);
                        if ($voucher->voucher_type == 0) {
                            $priceHandle = $sumPrice * (1 - ($voucher->discount / 100));
                        } else if ($voucher->voucher_type == 1) {
                            $priceHandle = $sumPrice - $voucher->discount;
                            if ($priceHandle < 0) {
                                $priceHandle = 0;
                            }
                        }
                    }

                $stripe = new StripeClient(env('STRIPE_SECRET'));
                $paymentIntent = $stripe->paymentIntents->create([
                    'amount' => $priceHandle,
                    'currency' => 'vnd',
                    'automatic_payment_methods' => [
                        'enabled' => true,
                    ],
                ]);

                return view('client.payment_online', [
                    'clientSecret' => $paymentIntent->client_secret,
                    'priceHandle' => $priceHandle,
                    'voucher_id' => $voucher_id_check,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->homenumber.'-'.$request->ward.'-'.$request->city.'-'.$request->country,
                    'product_id' => $product_id
                ]);

                break;
            case 'offline':
                $user = auth()->user();
                $priceHandle = 0;
                $productPrice = 0;
                $sumPrice = 0;
                $voucher_id = explode("-", $request->voucher_id);

                if (isset($request->product_id)) {
                    $idUserCart = $this->cartRepository->findUser($user->id);
                    $cartDetail = $this->cartDetailRepository->findProduct($request->product_id, $idUserCart->id);

                    if ( $cartDetail->product_type == 0 ) {
                        $productPrice = $cartDetail->price * (1 - ($cartDetail->discount / 100));
                    } else if ( $cartDetail->product_type == 1 ) {
                        $productPrice = $cartDetail->price - $cartDetail->discount;
                    }

                    $sumPrice = $productPrice * $cartDetail->quantity;


                    if ( $voucher_id['2'] == "" ) {
                        $priceHandle = $sumPrice;
                        $dataUser = [
                            'user_id' => $user->id,
                            'voucher_id' => null,
                            'name' => $request->name,
                            'phone' => $request->phone,
                            'address' => $request->homenumber.'-'.$request->ward.'-'.$request->city.'-'.$request->country,
                            'price' => $priceHandle,
                            'status' => 0
                        ];
                    } else {
                        $voucher = $this->voucherRepository->find($voucher_id[2]);
                        if ( $voucher->voucher_type == 0 ) {
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
                            'name' => $request->name,
                            'phone' => $request->phone,
                            'address' => $request->homenumber.'-'.$request->ward.'-'.$request->city.'-'.$request->country,
                            'price' => $priceHandle,
                            'status' => 0
                        ];
                    }

                    $orderId = $this->orderRepository->create($dataUser);

                    $data = [
                        'order_id' => $orderId->id,
                        'product_id' => $request->product_id,
                        'price' => $productPrice,
                        'quantity' => $cartDetail->quantity,
                        'image' => $cartDetail->image
                    ];

                    $this->orderDetailRepository->create($data);

                    return redirect()->route('infor_order')->with('msg', 'Mua Hàng Thành Công');
                } else {
                    $columnSelect = [
                        'carts.id as cart_id',
                        'products.price as price',
                        'carts_detail.quantity',
                        'carts_detail.image',
                        'carts_detail.id as cart_detail_id',
                        'products.name as product_name',
                        'products.id as product_id',
                        'products.sale as product_sale',
                        'products.discount',
                        'products.product_type'
                    ];

                    $cartDetails = $this->cartDetailRepository->getDetailCart($user->id, $columnSelect);
                    $voucher_id = explode("-", $request->voucher_id);
                    $idUserCart = $this->cartRepository->findUser($user->id);

                    foreach ($cartDetails as $cartDetail) {
                        if ( $cartDetail->product_type == 0 ) {
                            $productPrice = $cartDetail->price * (1 - ($cartDetail->discount / 100));
                        } else if ( $cartDetail->product_type == 1 ) {
                            $productPrice = $cartDetail->price - $cartDetail->discount;
                        }

                        $sumPrice += $productPrice * $cartDetail->quantity;
                    }


                    $priceHandle = 0;
                    if ( $voucher_id['2'] == "" ) {

                        $priceHandle = $sumPrice;
                        $dataUser = [
                            'user_id' => $user->id,
                            'voucher_id' => null,
                            'name' => $request->name,
                            'phone' => $request->phone,
                            'address' => $request->homenumber.'-'.$request->ward.'-'.$request->city.'-'.$request->country,
                            'price' => $priceHandle,
                            'status' => 0
                        ];
                    } else {

                        $voucher = $this->voucherRepository->find($voucher_id[2]);
                        if ($voucher->voucher_type == 0) {
                            $priceHandle = $sumPrice * (1 - ($voucher->discount / 100));
                        } else if ($voucher->voucher_type == 1) {
                            $priceHandle = $sumPrice - $voucher->discount;
                            if ($priceHandle < 0) {
                                $priceHandle = 0;
                            }
                        }
                        $dataUser = [
                            'user_id' => $user->id,
                            'voucher_id' => $voucher->id,
                            'name' => $request->name,
                            'phone' => $request->phone,
                            'address' => $request->homenumber.'-'.$request->ward.'-'.$request->city.'-'.$request->country,
                            'price' => $priceHandle,
                            'status' => 0
                        ];
                    }

                    $orderId = $this->orderRepository->create($dataUser);

                    foreach ( $cartDetails as $cartDetail ) {
                        if ( $cartDetail->product_type == 0 ) {
                            $productPrice = $cartDetail->price * (1 - ($cartDetail->discount / 100));
                        } else if ( $cartDetail->product_type == 1 ) {
                            $productPrice = $cartDetail->price - $cartDetail->discount;
                        }
                        $data = [
                            'order_id' => $orderId->id,
                            'product_id' => $cartDetail->product_id,
                            'price' => $productPrice,
                            'quantity' => $cartDetail->quantity,
                            'image' => $cartDetail->image
                        ];

                        $this->orderDetailRepository->create($data);

                    }

                    return redirect()->route('infor_order')->with('msg', 'Mua Hàng Thành Công');
                }
                break;
        }

    }

    // show list order client
    public function inforOrder()
    {
        $sumPrice = 0;
        $column = [
            'orders_detail.product_id',
            'products.name as product_name',
            'products.discount',
            'products.product_type',
            'products.price',
            'orders_detail.quantity',
            'products.image'
        ];
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
            'products.discount',
            'products.product_type',
            'orders_detail.created_at'
        ];
        $order_details = $this->orderDetailRepository->getOrderDetail($id_user, $id, $column);
        $order = $this->orderRepository->findOrder($id);
        $sumPrice = $order->price;

        if ( isset($user) ) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.show_order_detail', compact('order_details', 'count', 'order', 'sumPrice'));
    }

    // show list order admin
    public function list(Request $request)
    {
        $check_order = true;
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

        return view('admin.order.list_order', compact('orders', 'key', 'data', 'check_order'));
    }

    // deleted order
    public function deleted(int $id)
    {
        $this->orderRepository->update($id, ['status' => OrderConstant::UNSUCCESSFUL]);

        return redirect()->route('infor_order');
    }

    // re - order
    public function reOrder(int $id, Request $request)
    {
        $product_id = $request->productId;
        $sumPrice = 0;
        $column = [
            'orders_detail.product_id',
            'products.name as product_name',
            'products.discount',
            'products.product_type',
            'products.price',
            'orders_detail.quantity',
            'products.image'
        ];
        $user = auth()->user();
        $order = $this->orderRepository->findOrder($id);
        $cartDetails = $this->orderDetailRepository->getOrderDetail($user->id, $id, $column);
        $vouchers = $this->voucherRepository->getVoucherByConditionAdmin();

        $orderArray = $order->toArray();
        $address = explode("-", $orderArray['address']);

        foreach ($cartDetails as $product) {
            if ( $product->product_type == 0 ) {
                $priceHandle = $product->price * (1 - ($product->discount / 100));
            } else if ( $product->product_type == 1 ) {
                $priceHandle = $product->price - $product->discount;
            }

            $sumPrice += $priceHandle * $product->quantity;
        }


        if ( isset($user) ) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.reorder', compact('count', 'cartDetails', 'order', 'vouchers', 'sumPrice', 'product_id', 'address'));
    }

    // update status order admin
    public function update(Request $request)
    {
        $check = false;
        $data = $request->all();
        $order_details = $this->orderDetailRepository->getOrderDetailByCondition($data['id']);
        $order = $this->orderRepository->findOrder($data['id']);

        if (isset($order->voucher_id)) {
            $voucher = $this->voucherRepository->findVoucher($order->voucher_id);
        }

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
                foreach ($order_details as $order_detail) {
                    $storage = $this->storageRepository->findProduct($order_detail->product_id);
                    $this->storageRepository->updateProductId($order_detail->product_id, ['quantity' => $storage->quantity - $order_detail->quantity]);
                    $this->productRepository->update($order_detail->product_id, ['sale' => $order_detail->sale + $order_detail->quantity]);
                }

                if (isset($voucher)) {
                    $this->voucherRepository->update($voucher->id, ['quantity' => $voucher->quantity - 1]);
                }
                $check = true;
            }
        } else if ($data['oldStatus'] == OrderConstant::RECEIVED) {
            $check;
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
        $check_order = true;
        $column = [
            'orders_detail.*',
            'products.name'
        ];
        $order_details = $this->orderDetailRepository->getOrderDetail($id_user, $id, $column);
        $order = $this->orderRepository->findOrder($id);

        return view('admin.order.list_order_detail', compact('order_details', 'order', 'check_order'));
    }
}
