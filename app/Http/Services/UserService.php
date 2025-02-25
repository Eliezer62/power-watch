<?php

namespace App\Http\Services;

use App\Exceptions\UserCreationException;
use App\Exceptions\UserNotFoundException;
use App\Http\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

                case 23502:
                    throw new UserCreationException("Incorrets nulls values", 400);
                    break;

                case 22000:
                    throw new UserCreationException("Invalids types in array", 400);
                    break;

                default:
                    throw new UserCreationException("Error creating user", 500);
                    break;
            }
        } catch (\Exception $exception) {
            throw new UserCreationException("Error creating user", 500);
        }
    }

    public function findAll(): Collection
    {
        return User::query()->orderBy('name')->get();
    }

    public function findById(string $id): User
    {
        try {
            return User::findOrFail($id);
        } catch (\Exception $exception) {
            throw new UserNotFoundException("User not found", 404);
        }
    }

    public function findByEmail(string $email): User {
        try {
            return User::query()->where('email', $email)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            throw new UserNotFoundException("User not found", 404);
        }
    }

    public function update(string $id, UserDTO $dto): ?User {
        try {
            $user = User::findOrFail($id);
            $user->update($dto->toArray());
            $user->saveOrFail();
            return $user;
        } catch (UserNotFoundException $exception) {
            throw new UserNotFoundException("User not found", 404);
        } catch (QueryException $exception) {
            switch ($exception->getCode()) {
                case 23505:
                    throw new UserCreationException('E-mail already exists', 409);
                    break;

                case 23502:
                    throw new UserCreationException("Incorrect nulls values", 400);
                    break;

                case 22000:
                    throw new UserCreationException("Invalids types in request", 400);
                    break;

                default:
                    throw new UserCreationException("Error creating user", 500);
                    break;
            }
        } catch (\Exception $exception) {
            throw new UserCreationException("Error creating user", 500);
        }
    }

    public function patch(string $id, array $fields): ?User {
        try {
            $user = User::findOrFail($id);
            $user->update($fields);
            $user->saveOrFail();
            return $user;
        } catch (UserNotFoundException $exception) {
            throw new UserNotFoundException("User not found", 404);
        } catch (QueryException $exception) {
            switch ($exception->getCode()) {
                case 23505:
                    throw new UserCreationException('E-mail already exists', 409);
                    break;

                case 23502:
                    throw new UserCreationException("Incorrets nulls values", 400);
                    break;

                case 22000:
                    throw new UserCreationException("Invalids types in array", 400);
                    break;

                default:
                    throw new UserCreationException("Error creating user", 500);
                    break;
            }
        }catch (\Exception $exception) {
            throw new UserCreationException("Error creating user", 500);
        }
    }

    public function deleteById(string $id): void
    {
        User::find($id)->delete();
    }
}
