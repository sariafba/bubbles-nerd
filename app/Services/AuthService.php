<?php

namespace App\Services;

use App\Exceptions\UserException;
use App\Models\User;
use App\Repositories\AuthRepository;
use App\Repositories\AuthRepositoryInterface;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AuthService
{
    use ResponseTrait;

    protected AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $data)
    {
        try {
            $userWithToken = $this->authRepository->register($data);

            return $this->successWithData($userWithToken, 'Registered successfully', 201);
        }catch (\Exception $e) {
            return $this->failed($e->getMessage(), 422);
        }
    }

    public function login(array $credentials)
    {
        try {
            $userWithToken = $this->authRepository->login($credentials);

            return $this->successWithData($userWithToken, 'logged in successfully');
        }catch (\Exception $e){
            return $this->failed($e->getMessage(), 422);
        }
    }

    public function logout()
    {
        try {
            auth('api')->logout();

            return $this->successWithMessage('logged out successfully');
        }catch (\Exception $e){
            return $this->failed($e->getMessage(), 422);
        }
    }


}
