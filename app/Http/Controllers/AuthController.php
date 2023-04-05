<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session as SessionSession;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\StorageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ManufactureRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\CreateLoginFormRequest;
use App\Http\Requests\CreateRegisterFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use App\Constants\AuthConstant;


class AuthController extends Controller
{
    protected $userRepository;
    protected $productRepository;
    protected $storageRepository;
    protected $categoryRepository;
    protected $manufactureRepository;

    public function __construct(UserRepositoryInterface $userRepositoryInterface,
                                ProductRepositoryInterface $productRepositoryInterface,
                                StorageRepositoryInterface $storageRepositoryInterface,
                                CategoryRepositoryInterface $categoryRepositoryInterface,
                                ManufactureRepositoryInterface $manufactureRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
        $this->productRepository = $productRepositoryInterface;
        $this->storageRepository = $storageRepositoryInterface;
        $this->categoryRepository = $categoryRepositoryInterface;
        $this->manufactureRepository = $manufactureRepositoryInterface;
    }

    public function index()
    {
        return view('admin.login');
    }

    public function login(CreateLoginFormRequest $request)
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user =  auth()->user();

            if ($user->role == AuthConstant::ADMIN) {
                return redirect()->route('dashboard');
            }
            else if ($user->role == AuthConstant::CLIENT) {
                return redirect()->route('client_index');
            }
        }
        else {
            return redirect()->back()->with('msg', 'Wrong username or password');
        }
    }

    public function logout()
    {
        auth()->guard('web')->logout();

        return redirect()->route('login_page');
    }

    public function register_page()
    {
        return view('client.register');
    }

    public function register(CreateRegisterFormRequest $request)
    {
        if ($request->password === $request->repassword) {

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => AuthConstant::CLIENT,
                'repassword' => $request->repassword,
                'birthday' => Carbon::now(),
                'avatar' => 'no avatar yet',
                'address' => 'no address yet'
            ];

            $this->userRepository->create($data);

            return redirect()->route('login_page')->with('msg', 'Success');

        }
        else{
            return redirect()->route('register_page')->with('msg', 'Unsuccessful');
        }

    }


}
