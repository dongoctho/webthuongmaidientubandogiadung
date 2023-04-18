<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Http\Requests\CreateLoginFormRequest;
use App\Http\Requests\CreateRegisterFormRequest;
use App\Http\Requests\CreateChangePassFormRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use App\Constants\AuthConstant;
use Illuminate\Support\Facades\Auth;
use app\Models\User;

class AuthController extends Controller
{
    protected $userRepository;
    protected $productRepository;
    protected $storageRepository;
    protected $categoryRepository;
    protected $manufactureRepository;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    public function redirecToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->route('client_index');

            }else{
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id'=> $user->id,
                'phone' => '0123456789',
                'address' => 'hanoi',
                'avatar' => 'abc',
                'role' => AuthConstant::CLIENT,
                'birthday' => Carbon::now(),
                'password' => encrypt('my-google')
            ]);

            Auth::login($newUser);

            return redirect()->route('client_index');
        }
    }

    // show login page
    public function index()
    {
        return view('admin.login');
    }

    // login
    public function login(CreateLoginFormRequest $request)
    {
        if ( auth()->attempt(['email' => $request->email, 'password' => $request->password]) ) {
            $user =  auth()->user();
            if ( $user->role == AuthConstant::ADMIN ) {
                return redirect()->route('dashboard');
            } else if ( $user->role == AuthConstant::CLIENT ) {
                return redirect()->route('client_index');
            }
        } else {
            return redirect()->back()->with('msg', 'Wrong username or password');
        }
    }

    // logout
    public function logout()
    {
        auth()->guard('web')->logout();

        return redirect()->route('login_page');
    }

    // show register page
    public function register_page()
    {
        return view('client.register');
    }

    // show change password page
    public function change_pass_page()
    {
        return view('client.change_password');
    }

    // show register page
    public function change_pass(CreateChangePassFormRequest $request)
    {
        dd($request->toArray());
    }

    // register
    public function register(CreateRegisterFormRequest $request)
    {
        if ( $request->password === $request->repassword ) {
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
        } else {
            return redirect()->route('register_page')->with('msg', 'Unsuccessful');
        }
    }
}
