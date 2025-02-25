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
}
