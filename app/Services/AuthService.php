<?php

namespace App\Services;

use App\Exceptions\UserException;
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
            $user = $this->authRepository->register($data);

            return $this->successWithData($user, 'Registered successfully', 201);

        }catch (\Exception $e) {
            return $this->failed($e->getMessage(), 422);
        }
    }

    public function login(array $credentials)
    {
        try {
            $token = $this->authRepository->login($credentials);

            return $this->userToken($token);
        }catch (\Exception $e){
            return $this->failed($e->getMessage(), 422);
        }
    }


}
