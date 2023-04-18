<?php

namespace App\Http\Middleware;

use App\Constants\AuthConstant;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (Auth::user()->role == AuthConstant::CLIENT) {
            return route('login');
        }
    }
}
