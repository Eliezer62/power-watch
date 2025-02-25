<?php

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
