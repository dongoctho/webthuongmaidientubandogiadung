<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Http\Requests\CreateLoginFormRequest;
use App\Http\Requests\CreateRegisterFormRequest;
use App\Http\Requests\CreateChangePassFormRequest;
use App\Http\Requests\CreateAccountFormRequest;
use Illuminate\Support\Facades\Hash;
use App\Services\ImageService;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use App\Constants\AuthConstant;
use Illuminate\Support\Facades\Auth;
use app\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $userRepository;
    protected $image_service;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface,
        ImageService $imageService
    ) {
        $this->userRepository = $userRepositoryInterface;
        $this->image_service = $imageService;
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
        $user =  auth()->user();
        if ( $user->role == AuthConstant::ADMIN ) {
            return redirect()->route('dashboard');
        } else if ( $user->role == AuthConstant::CLIENT ) {
            return redirect()->route('client_index');
        } else if ( $user->role == AuthConstant::CONTENT ) {
            return redirect()->route('dashboard');
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

    // list account
    public function listUser(Request $request)
    {
        $key = "";
        $columnSelect = [
            'users.name',
            'users.email',
            'users.phone',
            'users.role',
            'users.birthday',
            'users.avatar',
            'users.address'
        ];

        $users = $this->userRepository->getUserByCondition($columnSelect);

        return view('admin.user.list_user', compact('users', 'key'));
    }

    // index create account
    public function indexUserAdmin()
    {
        return view('admin.user.add_user');
    }

    // add account admin
    public function createUserAdmin(CreateAccountFormRequest $request)
    {

        if ( $request -> has('avatar') ) {
            $image = $this->image_service->image($request->avatar);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'birthday' => $request->birthday,
            'avatar' => $image,
            'address' => $request->homenumber.'-'.$request->ward.'-'.$request->city.'-'.$request->country
        ];

        $this->userRepository->create($data);

        return redirect()->route('list_user');
    }

    public function updateRole(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $check = false;

        if ($user->role == AuthConstant::ADMIN) {
            if ($data['oldRole'] == AuthConstant::ADMIN) {
                return $check;
            } elseif ($data['oldRole'] == AuthConstant::CLIENT) {
                if ($data['role'] == AuthConstant::ADMIN) {
                    $check;
                } else {
                    $check = true;
                }
            } elseif ($data['oldRole'] == AuthConstant::CONTENT) {
                if ($data['role'] == AuthConstant::ADMIN) {
                    $check;
                } else {
                    $check = true;
                }
            }
        } else if ($user->role == AuthConstant::CONTENT) {
            if ($data['role'] == AuthConstant::ADMIN) {
                $check;
            } else {
                $check = true;
            }
        }
        if ($check == false) {
            return response()->json([
                'error' => $data['role'],
            ], 200);
        } else {
            $result = $this->userRepository->update($data['id'], ['role' => $data['role']]);
            if ($result != false) {
                return response()->json([
                    'success' => $data['role'],
                ], 201);
            }
        }
    }
}

