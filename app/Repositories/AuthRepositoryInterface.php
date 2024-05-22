<?php

namespace App\Repositories;

interface AuthRepositoryInterface
{
    public function register(array $data);

    public function login(array $credentials);

    public function  getAll();

    public function searchForTeacher($name);

}
