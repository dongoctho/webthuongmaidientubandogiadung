<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ManufactureRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\StorageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CartRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\VoucherRepositoryInterface;
use App\Http\Requests\CreateProductFormRequest;
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

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface,
        StorageRepositoryInterface $storageRepositoryInterface,
        CategoryRepositoryInterface $categoryRepositoryInterface,
        ManufactureRepositoryInterface $manufactureRepositoryInterface,
        CartRepositoryInterface $cartRepositoryInterface,
        VoucherRepositoryInterface $voucherRepositoryInterface
    ){
        $this->userRepository = $userRepositoryInterface;
        $this->productRepository = $productRepositoryInterface;
        $this->storageRepository = $storageRepositoryInterface;
        $this->categoryRepository = $categoryRepositoryInterface;
        $this->manufactureRepository = $manufactureRepositoryInterface;
        $this->cartRepository = $cartRepositoryInterface;
        $this->voucherRepository = $voucherRepositoryInterface;
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
        $products = $this->productRepository->getByCondition($data);
        $count = 0;

        if (isset($user)) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.product', compact('user', 'count', 'products'));
    }

    // show product detail client
    public function productDetail($id)
    {
        $user = auth()->user();
        $products = $this->productRepository->getByCondition("*");
        $product_detail = $this->productRepository->find($id);
        $storages = $this->storageRepository->findProduct($id);
        $count = 0;
        $manufacture = $this->manufactureRepository->find($product_detail->manufacture_id);

        if (isset($user)) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.product_detail', [
            'products' => $products,
            'product_detail' => $product_detail,
            'storages' => $storages,
            'manufactures' => $manufacture,
            'count' => $count,
        ]);
    }

    // show index product admin
    public function index()
    {
        $manufactures = $this->manufactureRepository->getAll();
        $categories = $this->categoryRepository->getAll();

        return view('admin.product.add_product', [
            'manufactures' => $manufactures,
            'categories' => $categories
        ]);
    }

    // create product admin
    public function create(CreateProductFormRequest $request)
    {
        $manufactures = $this->manufactureRepository->getAll();
        $categories = $this->categoryRepository->getAll();

        if ( $request -> has('image') )
        {
            $file = $request->image;
            $ext = $request->image->extension();
            $file_name = time().'-'.'product.'.$ext;
            $file->move(public_path('uploads'), $file_name);
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
            'image' => $file_name
        ];

        $this->productRepository->create($data);

        return view('admin.product.add_product', [
            'manufactures' => $manufactures,
            'categories' => $categories
        ])->with('msg', 'Created');
    }

    // show list product admin
    public function list()
    {
        $products = $this->productRepository->getAll();
        $manufactures = $this->manufactureRepository->getAll();
        $categories = $this->categoryRepository->getAll();

        return view('admin.product.list_product', [
            'products' => $products,
            'manufactures' => $manufactures,
            'categories' => $categories
        ]);
    }

    // delete product admin
    public function destroy(int $id)
    {
        $this->productRepository->delete($id);

        return redirect()->back();
    }

    // show edit product admin
    public function show(int $id)
    {
        $products = $this->productRepository->find($id);
        $manufactures = $this->manufactureRepository->getAll();
        $categories = $this->categoryRepository->getAll();

        return view('admin.product.show_product', [
            'products' => $products,
            'manufactures' => $manufactures,
            'categories' => $categories
        ]);
    }

    // edit product admin
    public function update(int $id, CreateProductFormRequest $request)
    {
        if ( $request->image == null )
        {
            $data = [
                'code' => $request->code,
                'name' => $request->name,
                'price' => $request->price,
                'discount' => $request->discount,
                'product_type' => $request->product_type,
                'category_id' => $request->category_id,
                'manufacture_id' => $request->manufacture_id,
                'description' => $request->description,
            ];
            $this->productRepository->update($id, $data);

            return redirect()->route('list_product');
        }
        else {
            $file = $request->image;
            $ext = $request->image->extension();
            $file_name = time().'-'.'product.'.$ext;
            $file->move(public_path('uploads'), $file_name);

            $data = [
                'code' => $request->code,
                'name' => $request->name,
                'price' => $request->price,
                'discount' => $request->discount,
                'product_type' => $request->product_type,
                'category_id' => $request->category_id,
                'manufacture_id' => $request->manufacture_id,
                'description' => $request->description,
                'image' => $file_name
            ];

            $this->productRepository->update($id, $data);

            return redirect()->route('list_product');
        }
    }
}
