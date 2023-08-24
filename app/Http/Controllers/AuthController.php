<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\PasswordResetRepositoryInterface;
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
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Support\Str;
use Route;

class AuthController extends Controller
{
    protected $userRepository;
    protected $image_service;
    protected $passwordResetRepository;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface,
        ImageService $imageService,
        PasswordResetRepositoryInterface $PasswordResetRepositoryInterface
    ) {
        $this->userRepository = $userRepositoryInterface;
        $this->image_service = $imageService;
        $this->passwordResetRepository = $PasswordResetRepositoryInterface;
    }

    public function indexForgot()
    {
        return view('admin.forgot_password');
    }

    public function change_pass_page()
    {
        return view('admin.change_password');
    }

    public function change_pass(CreateChangePassFormRequest $request, $email, $token)
    {
        $checkToken = $this->passwordResetRepository->findToken($token);
        if (isset($checkToken)) {
            if ($request->password != $request->repassword) {
                return redirect()->back()->with('msg', 'Mật khẩu nhập lại không đúng');
            }
            $password = Hash::make($request->password);
            $findEmail = $this->userRepository->findEmail($email);
            $this->userRepository->update($findEmail->id, ['password' => $password]);

            return redirect()->route('login_page')->with('msg', 'Thành công! Hãy đăng nhập');
        }

        return redirect()->route('index_forgot')->with('msg', 'Đổi mật khẩu không thành công');
    }

    public function forgotPassword(Request $request)
    {
        $findEmail = $this->userRepository->findEmail($request->email);
        $token = Str::random(60);

        if ($findEmail != null) {
            $passwordResetCheck = $this->passwordResetRepository->findEmail($request->email);

            if ($passwordResetCheck == null) {
                $passwordReset = $this->passwordResetRepository->create(['email' => $request->email, 'token' => $token]);
            } else {
                $this->passwordResetRepository->UpdateToken($request->email, $token);
                $passwordReset = $this->passwordResetRepository->findToken($token);
            }
            $mailData = route('change_pass_page', ['email' => $request->email, 'token' => $passwordReset->token]);
            Mail::to($request->email)->send(new SendEmail($mailData));

            return redirect()->back()->with('msg', 'Thành công! Hãy kiểm tra địa chỉ email của bạn');
        } else {
            return redirect()->back()->with('msg', 'Địa chỉ Email không tồn tại');
        }

    }

    public function redirecToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

            $userFind = $this->userRepository->findUser($user->id);

            if($userFind){

                Auth::login($userFind);

                return redirect()->route('client_index');

            }else{
            $newUser = [
                'name' => $user->name,
                'email' => $user->email,
                'google_id'=> $user->id,
                'phone' => '0123456789',
                'address' => 'hanoi',
                'avatar' => 'abc',
                'role' => AuthConstant::CLIENT,
                'birthday' => Carbon::now(),
                'password' => encrypt('my-google')
            ];

            $new_user = $this->userRepository->create($newUser);

            Auth::login($new_user);

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
            'birthday' => $request->birthday,
            'avatar' => 'no avatar yet',
            'address' => 'no address yet'
        ];

        $this->userRepository->create($data);

        return redirect()->route('login_page')->with('msg', 'Thành công');
    }

    // list account
    public function listUser(Request $request)
    {
        $check_user = true;
        $key = "";
        $data = [
            'key' => $request->key
        ];
        $key = $request->key;

        $users = $this->userRepository->getUserByCondition($data);

        return view('admin.user.list_user', compact('users', 'key', 'data', 'check_user'));
    }

    // index create account
    public function indexUserAdmin()
    {
        $check_user = true;
        return view('admin.user.add_user', compact('check_user'));
    }

    // delete user
    public function destroy(int $id)
    {
        $this->userRepository->delete($id);

        return redirect()->back();
    }

    // add account admin
    public function createUserAdmin(CreateAccountFormRequest $request)
    {
        if ( $request->has('avatar') ) {
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

