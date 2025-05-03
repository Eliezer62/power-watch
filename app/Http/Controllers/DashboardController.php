<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Services\DashboardService;

class DashboardController extends Controller
{
    private DashboardService $service;
    public function __construct(DashboardService $service) {
        $this->service  = $service;
    }

    public function notWorking(): JsonResponse
    {
        return response()->json($this->service->findSensorsNotWorking(), 200);
    }

    public function reports(): JsonResponse
    {
        return response()->json($this->service->reports(), 200);
    }
}
