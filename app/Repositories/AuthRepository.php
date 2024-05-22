<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Exceptions\UserException;
use App\Models\User;
use App\Traits\ResponseTrait;
use App\Traits\StorePhotoTrait;
use Illuminate\Support\Facades\DB;
use NextApps\VerificationCode\VerificationCode;
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

            if (isset($data['avatar']))
                $user->avatar = $this->store($data['avatar'],'user-avatars');

            if(isset($data['subject']))
                $user->subjects()->attach($data['subject']);

            VerificationCode::send($user->email);

            $user->save();

            DB::commit();
        }
        catch (\Exception $e){
            DB::rollBack();
            throw new UserException("Unable to create user: " . $e->getMessage());
        }
    }

    public function login(array $credentials)
    {
        try {
            DB::beginTransaction();

            $token = auth('api')->attempt($credentials);

            if($token) {
                $user = User::where('email', $credentials['email'])->first();
                DB::commit();
                return $this->userWithToken($user, $token);
            } else
                throw new UserException('wrong password');
        }catch (\Exception $e){
                 throw new userException("Unable to login: " . $e->getMessage());
        }
    }


    public function getAll(){

        $user=User::Where('user_type','teacher')->get();

        if(!$user) {
            throw new NotFoundException();
        }
        return $user;
    }

    public function searchForTeacher($name)
    {
        $teacher= User::Where('user_type','teacher')->where('name', 'like', '%' . $name . '%')
            ->get();
        if (!$teacher) {
            throw new NotFoundException();
        }
        return $teacher;
    }

}
