<?php

namespace App\Http\Controllers;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ManufactureRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\StorageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CartRepositoryInterface;
use App\Http\Requests\CreateQuantityCartFormRequest;
use App\Constants\CartConstant;
use App\Repositories\Contracts\RepositoryInterface\CartDetailRepositoryInterface;
use Illuminate\Http\Request;
use App\Services\SumPriceService;

class CartController extends Controller
{
    protected $userRepository;
    protected $productRepository;
    protected $storageRepository;
    protected $categoryRepository;
    protected $manufactureRepository;
    protected $cartRepository;
    protected $cartDetailRepository;
    protected $sum_price_service;

    public function __construct (
        ProductRepositoryInterface $productRepositoryInterface,
        StorageRepositoryInterface $storageRepositoryInterface,
        CategoryRepositoryInterface $categoryRepositoryInterface,
        ManufactureRepositoryInterface $manufactureRepositoryInterface,
        CartRepositoryInterface $cartRepositoryInterface,
        CartDetailRepositoryInterface $cartDetailRepositoryInterface,
        SumPriceService $sumPriceService
    ) {
        $this->productRepository = $productRepositoryInterface;
        $this->storageRepository = $storageRepositoryInterface;
        $this->categoryRepository = $categoryRepositoryInterface;
        $this->manufactureRepository = $manufactureRepositoryInterface;
        $this->cartRepository = $cartRepositoryInterface;
        $this->cartDetailRepository = $cartDetailRepositoryInterface;
        $this->sum_price_service = $sumPriceService;
    }

    // Add product to cart
    public function addCart($id, CreateQuantityCartFormRequest $request)
    {
        $user = auth()->user();
        $product = $this->productRepository->find($id);
        $idUserCart = $this->cartRepository->findUser($user->id);
        $storage = $this->storageRepository->findProduct($product->id);

        if ( $request->quantity > $storage->quantity ){
            return redirect()->back()->with('msg', 'Số lượng nhập không được vượt quá hàng trong kho');
        }
        if ( $product->product_type == 0 ) {
            $priceHandle = $product->price * (1 - ($product->discount / 100));
        } else if ( $product->product_type == 1 ) {
            $priceHandle = $product->price - $product->discount;
        }

        if ( isset($idUserCart) ) {
            $cartDetail = $this->cartDetailRepository->findProduct($id, $idUserCart->id);

            if ( $cartDetail == null ) {

                $data = [
                    'cart_id' => $idUserCart->id,
                    'product_id' => $id,
                    'price' => $priceHandle,
                    'quantity' => $request->quantity,
                    'image' => $product->image
                ];

                $this->cartDetailRepository->create($data);

                return redirect()->back();
            } else if ( $id == $cartDetail->product_id ) {
                if ( $request->quantity + $cartDetail->quantity > $storage->quantity ) {
                    return redirect()->back()->with('msg', 'Số lượng nhập không được vượt quá hàng trong kho');
                }

                $dataCart = [
                    'quantity' => $request->quantity + $cartDetail->quantity,
                ];

                $this->cartDetailRepository->update($cartDetail->id, $dataCart);

                return redirect()->back();
            }
        } else {
            $dataUser = [
                'user_id' => $user->id
            ];

            $cartId = $this->cartRepository->create($dataUser);

            $data = [
                'cart_id' => $cartId->id,
                'product_id' => $id,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image' => $product->image
            ];
            $this->cartDetailRepository->create($data);

            return redirect()->back();
        }
    }

    // delete cart
    public function deleted($id)
    {
        $this->cartDetailRepository->delete($id);

        return redirect()->back();
    }

    // Change price cart
    public function changePrice(Request $request)
    {
        $data = $request->all();
        $cart = $this->cartDetailRepository->find($data['id']);
        $storage = $this->storageRepository->findProduct($data['productId']);
        $priceCart = $cart->price * $data['quantity'];

        if ( $data['quantity'] > $storage->quantity ) {
            return redirect()->back()->with('msg', 'Số lượng nhập không được vượt quá hàng trong kho');
        }

        $input = [
            'quantity' => $data['quantity']
        ];

        $this->cartDetailRepository->update($data['id'], $input);

        $column = [
            'carts_detail.quantity',
            'products.name',
            'products.price',
            'products.discount',
            'products.product_type',
            'products..image',
            'carts_detail.product_id'
        ];

        $carts = $this->cartDetailRepository->getDetailCart($column);

        $sum = 0;

        foreach ($carts as $product) {
            if ($product->product_type == 0) {
                $priceCart = $product->price * (1 - ($product->discount / 100));
            } elseif ($product->product_type == 1) {
                $priceCart = $product->price - $product->discount;
            }
            $sum += $priceCart * $product->quantity;
        }

        return response()->json([
            'cartId' => $data['id'],
            'priceItem' => $priceCart,
            'sum' => $sum
        ], 201);
    }

    // show cart client
    public function showCart()
    {
        $buttonPlus = CartConstant::BUTTON_PLUS;
        $buttonMinus = CartConstant::BUTTON_MINUS;
        $sumPrice = 0;

        $columnSelect = [
            'carts_detail.id as id',
            'carts.id as carts_id',
            'carts_detail.price as cart_price',
            'carts_detail.quantity as quantity',
            'storages.quantity as storage_quantity',
            'carts_detail.image',
            'carts_detail.id as cart_detail_id',
            'products.name as product_name',
            'carts_detail.product_id as product_id',
            'products.price as price',
            'products.sale as product_sale',
            'products.discount',
            'products.product_type'
        ];

        $user = auth()->user();
        $count = $this->cartRepository->countProductInCart($user->id);
        $cartDetails = $this->cartDetailRepository->getDetailCart($user->id, $columnSelect);

        foreach ($cartDetails as $product) {
            if ( $product->product_type == 0 ) {
                $priceCart = $product->price * (1 - ($product->discount / 100));
            } else if ( $product->product_type == 1 ) {
                $priceCart = $product->price - $product->discount;
            }

            $sumPrice += $priceCart * $product->quantity;
        }

        return view('client.cart_detail', compact('cartDetails', 'count', 'sumPrice', 'buttonPlus', 'buttonMinus'));
    }

    // show list cart admin
    public function list(Request $request)
    {
        $check_cart = true;
        $key = "";
        $data = [
            'key' => $request->key
        ];
        $key = $request->key;
        $carts = $this->cartRepository->getCartByCondition($data);

        return view('admin.cart.list_cart', compact('carts', 'key', 'data', 'check_cart'));
    }

    // show cart detail admin
    public function listCartDetail(int $id_user)
    {
        $check_cart = true;
        $cart_details = $this->cartDetailRepository->getCartDetail($id_user);

        return view('admin.cart.list_cart_detail', compact('cart_details', 'check_cart'));
    }
}
