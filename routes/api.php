<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\TodoGroupController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

Route::get('todos/group/{groupId}', [TodoController::class, 'getByGroup'])->name('api.todos.group');

Route::apiResource('todos', TodoController::class)->names('api.todos');

Route::apiResource('todo-groups', TodoGroupController::class)->names('api.todo-groups');
});

