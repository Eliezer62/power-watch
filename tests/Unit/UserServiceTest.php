<?php

namespace tests\Unit;
use App\Enum\UserRole;
use App\Http\DTOs\UserDTO;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Tests\TestCase;

class UserServiceTest extends TestCase {
    public function testCreate() {
        $userServiceMock = Mockery::mock(UserService::class);

        $userServiceMock->shouldReceive('create')
                        ->once()
                        ->with(UserDTO::class)
                        ->andReturn(new User([
                            'id' => 1,
                            'email' => 'test@test.com',
                            'password' => 'temporaria',
                            'name' => 'Example',
                            'role' => UserRole::User,
                        ]));

        $user = $userServiceMock->create(new UserDTO('Example', 'test@test.com', UserRole::User));
        expect($user)->toBeInstanceOf(User::class)
            ->and($user->email)->toBe('test@test.com')
            ->and($user->name)->toBe('Example')
            ->and($user->role)->toBe(UserRole::User)
            ->and(Hash::check('temporaria', $user->password))->toBeTrue();
    }

    /**
     * Verify if findAll return like Eloquent's query
     * @return void
     */
    public function testFindAll() {
        $userService = new UserService();
        expect($userService->findAll()->toArray())->toBeArray();
        expect($userService->findAll()->toArray())->toBe(User::query()->orderBy('name')->get()->toArray());
    }

    public function testFindById() {
        $userService = new UserService();
        $id = $userService->findAll()->first()->id;

        expect($userService->findById($id)->id)->toBe(User::find($id)->id);
    }

    public function testUpdate() {
        $user = User::all()->first();
        $user->name = "teste";
        $userServiceMock = Mockery::mock(UserService::class);
        $userServiceMock->shouldReceive('update')
            ->once()
            ->with($user->id,UserDTO::class)
            ->andReturn($user);

        $userUpdated = $userServiceMock->update($user->id, new UserDTO("teste", $user->email, $user->role) );
        expect($userUpdated)->toBeInstanceOf(User::class)
            ->and($userUpdated->email)->toBe($user->email)
            ->and($userUpdated->name)->toBe('teste')
            ->and($userUpdated->role)->toBe($user->role);
    }
}
