<?php

namespace App\Http\Controllers;

use App\Http\Middleware\MyMiddlewares\IsUserVerified;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;

        $this->middleware(['auth:api'])->only('logout');
        $this->middleware(IsUserVerified::class)->only('login');

    }

    public function register(RegisterRequest $request)
    {
        return $this->authService->register($request->safe()->all());
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request->safe()->all());
    }

    public function logout()
    {
        return $this->authService->logout();
    }

    public function getAll()
    {
        return $this->authService->getAll();
    }

    public function searchForTeacher($name)
    {
        return $this->authService->searchForTeacher($name);
    }


}






