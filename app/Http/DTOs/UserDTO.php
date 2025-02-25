<?php

namespace App\Http\DTOs;

use App\Enum\UserRole;
use Illuminate\Http\Request;

class UserDTO {
    private string $name;
    private string $email;
    private UserRole $role;

    public static function fromRequest(Request $request): UserDTO
    {
        return new UserDTO(
            $request->input('name'),
            $request->input('email'),
            UserRole::from($request->input('role'))
        );
    }

    public function __construct(string $name, string $email, UserRole $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }

    public function toArray():array {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role
        ];
    }
}
