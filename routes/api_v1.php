<?php

use App\Http\Controllers\Api\V1\CommentsController;
use App\Http\Controllers\Api\V1\TasksController;
use App\Http\Controllers\Api\V1\TeamsController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware(['auth:sanctum']);
    Route::get('/unauthorised', [UserController::class, 'unauthorised'])->name('unauthorised');
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/tasks', TasksController::class);
    Route::prefix('tasks')->name('comment.')->group(function () {
        Route::get('/{taskId}/comments', [CommentsController::class, 'index'])->name('index');
        Route::post('/{taskId}/comments', [CommentsController::class, 'store'])->name('store');
    });

    Route::delete('/comments/{id}', [CommentsController::class, 'destroy'])->name('comment.destroy');

    Route::prefix('teams')->name('team.')->group(function () {
        Route::get('/', [TeamsController::class, 'index'])->name('index');
        Route::post('/', [TeamsController::class, 'store'])->name('store');
        Route::post('/{teamId}/Users', [TeamsController::class, 'update'])->name('update');
        Route::delete('/{teamId}/Users/{userId}', [TeamsController::class, 'destroy'])->name('destroy');
    });
});
