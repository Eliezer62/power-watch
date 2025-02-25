<?php

namespace App\Http\Controllers;

use App\Http\Requests\SensorRequest;
use App\Http\Services\SensorService;
use App\Http\Services\UserService;
use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    private SensorService $sensorService;
    public function __construct(SensorService $sensorService) {
        $this->sensorService = $sensorService;
    }

    public function store(SensorRequest $request) {
        return response()
            ->json($this->sensorService->create($request), 201);
    }

    public function index() {
        return response()
            ->json($this->sensorService->findAll(),200);
    }

    public function show(string $id) {
        return response()
            ->json($this->sensorService->findById($id),200);
    }

    public function update(SensorRequest $request, string $id) {
        return response()
            ->json($this->sensorService->update($id, $request), 200);

    }

    public function patch(Request $request, string $id) {
        return response()
            ->json($this->sensorService->patch($id, $request->all()), 200);
    }

    public function destroy(string $id) {
        $this->sensorService->deleteById($id);
        return response(status: 200);
    }
}
