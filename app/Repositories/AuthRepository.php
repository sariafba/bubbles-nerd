<?php

namespace App\Repositories;

use App\Exceptions\UserException;
use App\Models\User;
use App\Traits\ResponseTrait;
use App\Traits\StorePhotoTrait;
use Brick\Math\Exception\MathException;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthRepository implements AuthRepositoryInterface
{
    use ResponseTrait;
    use StorePhotoTrait;

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @throws UserException
     */
    public function register(array $data)
    {
        try {
            DB::beginTransaction();

            $user = $this->user->create([
                'user_type' => $data['user_type'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'school' => $data['school'] ?? null,
                'bio' => $data['bio'] ?? null,
                'password' => $data['password']
            ]);

            if (isset($data['avatar'])) {
                $user->avatar = $this->store($data['avatar'], 'users-avatars');
            } else {
                $user->avatar = null;
            }

            if($data['user_type'] === 'teacher')
                foreach ($data['subject'] as $subject)
                    $user->subjects()->attach($subject);


            $user->save();

            DB::commit();

//            $token = JWTAuth::fromUser($user); todo: the different?
            $token = auth('api')->login($user);

            return $this->userWithToken($user, $token);
        }
        catch (\Exception $e){
            DB::rollBack();
            throw new UserException(("Unable to create user: "). $e->getMessage());
        }
    }

    public function login(array $credentials)
    {
        try {
            DB::beginTransaction();

            $token = auth('api')->attempt($credentials);

            if($token)
            {
                DB::commit();
                return $token;
            }
            else
                throw new UserException('bad credentials');
        }catch (\Exception $e){
                 throw new userException($e->getMessage());
        }
    }

}
