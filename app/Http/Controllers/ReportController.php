<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Http\Services\ReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    private ReportService $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function store(ReportRequest $request): JsonResponse
    {
        return response()
            ->json($this->reportService->create($request), 201);
    }

    public function index()
    {
        return response()
            ->json($this->reportService->findAll(), 200);
    }

    public function show(string $id) {
        return response()
            ->json($this->reportService->findById($id), 200);
    }

    public function update(ReportRequest $request, string $id) {
        return response()
            ->json($this->reportService->update($request, $id), 200);
    }

    public function patch(Request $request, string $id)
    {
        return response()
            ->json($this->reportService->patch($request, $id), 200);
    }

    public function destroy(string $id): Response
    {
        $this->reportService->delete($id);
        return response(status: 200);
    }
}
