<?php

namespace App\Http\Controllers;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ManufactureRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\StorageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CartRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CartDetailRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Http\Requests\EditInforFormRequest;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class IndexController extends Controller
{
    protected $userRepository;
    protected $productRepository;
    protected $storageRepository;
    protected $categoryRepository;
    protected $manufactureRepository;
    protected $cartRepository;
    protected $cartDetailRepository;

    public function __construct(
        ProductRepositoryInterface $productRepositoryInterface,
        StorageRepositoryInterface $storageRepositoryInterface,
        CategoryRepositoryInterface $categoryRepositoryInterface,
        ManufactureRepositoryInterface $manufactureRepositoryInterface,
        CartRepositoryInterface $cartRepositoryInterface,
        CartDetailRepositoryInterface $cartDetailRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface
    ){
        $this->productRepository = $productRepositoryInterface;
        $this->storageRepository = $storageRepositoryInterface;
        $this->categoryRepository = $categoryRepositoryInterface;
        $this->manufactureRepository = $manufactureRepositoryInterface;
        $this->cartRepository = $cartRepositoryInterface;
        $this->cartDetailRepository = $cartDetailRepositoryInterface;
        $this->userRepository = $userRepositoryInterface;
    }

    public function information()
    {
        $user = auth()->user();
        $count = $this->cartRepository->countProductInCart($user->id);

        return view('client.information', [
            'count' => $count,
            'user' => $user
        ]);
    }

    public function editInformation()
    {
        $user = auth()->user();
        $count = $this->cartRepository->countProductInCart($user->id);

        return view('client.edit_information', [
            'count' => $count,
            'user' => $user
        ]);
    }

    public function editInfor(EditInforFormRequest $request)
    {
        $user = auth()->user();
        if ( $request->avatar == null )
        {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'address' => $request->address
            ];
            $this->userRepository->update($user->id, $data);

            return redirect()->route('infor_index');
        }
        else {
            $file = $request->avatar;
            $ext = $request->avatar->extension();
            $file_name = time().'-'.'information.'.$ext;
            $file->move(public_path('uploads'), $file_name);

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'avatar' => $file_name
            ];
            $this->userRepository->update($user->id, $data);

            return redirect()->route('infor_index');
        }
    }

    // show  index client
    public function indexClient(Request $request)
    {
        $data = [
            'seachByPrice' => $request->seachByPrice,
            'seachByCategory' => $request->seachByCategory,
            'findProductByName' => $request->findProductByName
        ];
        $condition = $data;
        $user = auth()->user();
        $count = 0;
        $products = $this->storageRepository->getProductSale($condition);

        if (isset($user)) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.index', [
            'products' => $products,
            'user' => $user,
            'count' => $count,
        ]);
    }

    // show index contact
    public function indexContact()
    {
        $user = auth()->user();
        $products = $this->productRepository->getAll();
        $count = 0;

        if (isset($user)) {
            $count = $this->cartRepository->countProductInCart($user->id);
        }

        return view('client.contact', [
            'products' => $products,
            'user' => $user,
            'count' => $count
        ]);
    }

}
