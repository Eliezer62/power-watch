<?php

namespace App\Http\Controllers;

use App\Http\DTOs\UserDTO;
use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function store(UserRequest $request) {
        $userDto = UserDto::fromRequest($request);

        return response()->json($this->userService->create($userDto), 201);
    }

    public function index() {
        return response()
            ->json($this->userService->findAll(), 200);
    }

    public function show(string $id) {
        return response()
            ->json($this->userService->findById($id), 200);
    }

    public function update(UserRequest $request, string $id) {
        $dto = UserDto::fromRequest($request);
        return response()
            ->json($this->userService->update($id, $dto), 200);
    }

    public function patch(Request $request, string $id) {
        $fields = $request->request->all();
        return response()
            ->json($this->userService->patch($id, $fields), 200);
    }

    public function destroy(string $id) {
        $this->userService->deleteById($id);
        return response(status: 200);
    }
}
