<?php

namespace App\Http\Services;

use App\Http\DTOs\UserDTO;
use App\Http\Exceptions\UserCreationException;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class UserService {
    public function create(UserDTO $dto): ?User {
        try{
            $data = $dto->toArray();
            $data['password'] = Hash::make('temporaria');
            $user = User::create($data);
            return $user;
        } catch (QueryException $e) {
            switch ($e->getCode()) {
                case 23505:
                    throw new UserCreationException('User already exists', 409);
                    break;
            }
            return null;
        }
    }

    public function findAll(): Collection
    {
        return User::query()->orderBy('name')->get();
    }
}
