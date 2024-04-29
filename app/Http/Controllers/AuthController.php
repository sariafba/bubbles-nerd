<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsTeacher;
use App\Http\Middleware\IsUserVerified;
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













    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
