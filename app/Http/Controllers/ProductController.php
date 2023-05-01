<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ManufactureRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\StorageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CartRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\VoucherRepositoryInterface;
use App\Services\ImageService;
use App\Http\Requests\CreateProductFormRequest;
use App\Http\Requests\EditProductFormRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $userRepository;
    protected $productRepository;
    protected $storageRepository;
    protected $categoryRepository;
    protected $manufactureRepository;
    protected $cartRepository;
    protected $voucherRepository;
    protected $image_service;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface,
        StorageRepositoryInterface $storageRepositoryInterface,
        CategoryRepositoryInterface $categoryRepositoryInterface,
        ManufactureRepositoryInterface $manufactureRepositoryInterface,
        CartRepositoryInterface $cartRepositoryInterface,
        VoucherRepositoryInterface $voucherRepositoryInterface,
        ImageService $imageService
    ) {
        $this->userRepository = $userRepositoryInterface;
        $this->productRepository = $productRepositoryInterface;
        $this->storageRepository = $storageRepositoryInterface;
        $this->categoryRepository = $categoryRepositoryInterface;
        $this->manufactureRepository = $manufactureRepositoryInterface;
        $this->cartRepository = $cartRepositoryInterface;
        $this->voucherRepository = $voucherRepositoryInterface;
        $this->image_service = $imageService;
    }

    // show index client product
    public function indexProduct(Request $request)
    {
        $data = [
            'seachByPrice' => $request->seachByPrice,
            'seachByCategory' => $request->seachByCategory,
            'findProductByName' => $request->findProductByName
        ];

        $user = auth()->user();
        $condition = $request->seachByPrice;
        $products = $this->productRepository->getByCondition($data);
        $count = 0;

        if ( isset($user) ) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.product', compact('user', 'count', 'products', 'condition', 'data'));
    }

    // show product detail client
    public function productDetail($id)
    {
        $column = [
            'products.*'
        ];
        $user = auth()->user();
        $product_detail = $this->productRepository->find($id);
        $storages = $this->storageRepository->findProduct($id);
        $manufacture = $this->manufactureRepository->find($product_detail->manufacture_id);
        $products = $this->productRepository->getProductByCategory($product_detail->category_id, $column);
        $count = 0;

        if ( isset($user) ) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.product_detail', compact('products', 'product_detail', 'storages', 'manufacture', 'count'));
    }

    // show add product page admin
    public function index()
    {
        $check_product = true;
        $manufactures = $this->manufactureRepository->getAll();
        $categories = $this->categoryRepository->getAll();

        return view('admin.product.add_product', compact('manufactures', 'categories', 'check_product'));
    }

    // create product to database admin
    public function create(CreateProductFormRequest $request)
    {
        if ( $request -> has('image') ) {
            $image = $this->image_service->image($request->image);
        }

        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'price' => $request->price,
            'discount' => 0,
            'product_type' => 0,
            'category_id' => $request->category_id,
            'manufacture_id' => $request->manufacture_id,
            'description' => $request->description,
            'sale' => 0,
            'image' => $image
        ];

        $this->productRepository->create($data);

        return redirect()->route('list_product')->with('msg', 'Created');
    }

    // show list product admin
    public function list(Request $request)
    {
        $check_product = true;
        $key = "";
        $data = [
            'key' => $request->key
        ];

        $key = $request->key;
        $products = $this->productRepository->getProductByCondition($data);
        $manufactures = $this->manufactureRepository->getAll();
        $categories = $this->categoryRepository->getAll();

        return view('admin.product.list_product', compact('products', 'manufactures', 'categories', 'key', 'data', 'check_product'));
    }

    // delete product admin
    public function destroy(int $id)
    {
        $this->productRepository->delete($id);

        return redirect()->back();
    }

    // show information product admin
    public function show(int $id)
    {
        $check_product = true;
        $products = $this->productRepository->find($id);
        $manufactures = $this->manufactureRepository->getAll();
        $categories = $this->categoryRepository->getAll();

        return view('admin.product.show_product', compact('products', 'manufactures', 'categories', 'check_product'));
    }

    // edit information product admin
    public function update(int $id, EditProductFormRequest $request)
    {
        $data = $request->all();
        if (isset($data['image'])) {
            $data['image'] = $this->image_service->image($data['image']);
        }
        $this->productRepository->update($id, $data);

        return redirect()->route('list_product');
    }
}
