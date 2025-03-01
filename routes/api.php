<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->prefix('/user')
    ->group(function () {
        Route::post("/", 'store')
             ->name("user.store");

        Route::get("/", 'index')
            ->name("user.index");

        Route::get("/{id}", 'show')
            ->name("user.show");

        Route::put("/{id}", 'update')
            ->name("user.update");

        Route::patch("/{id}", 'patch')
            ->name("user.patch");

        Route::delete("/{id}", 'destroy')
            ->name("user.destroy");
    });

Route::controller(SensorController::class)
    ->prefix('/sensor')
    ->group(function () {
        Route::post("/", 'store')
            ->name("sensor.store");

        Route::get("/", 'index')
            ->name("sensor.index");

        Route::get("/{id}", 'show')
            ->name("sensor.show");

        Route::put("/{id}", 'update')
            ->name("sensor.update");

        Route::patch("/{id}", 'patch')
            ->name("sensor.patch");

        Route::delete("/{id}", 'destroy')
            ->name("sensor.destroy");
    });

Route::controller(ReportController::class)
    ->prefix('/report')
    ->group(function () {
        Route::post("/", 'store')
            ->name("report.store");

        Route::get("/", 'index')
            ->name("report.index");

        Route::get("/{id}", 'show')
            ->name("report.show");

        Route::put("/{id}", 'update')
            ->name("report.update");

        Route::patch("/{id}", 'patch')
            ->name("report.patch");

        Route::delete("/{id}", 'destroy')
            ->name("report.destroy");
    });
