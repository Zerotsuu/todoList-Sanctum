<?php

use App\Http\Controllers\Page\TodoController;
use App\Http\Controllers\Page\GroupController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {return Inertia::render('Dashboard');})->name('dashboard');
    
    Route::resource('todos', TodoController::class)
        ->except(['destroy', 'update', 'store'])
        ->names('page.todo');

    Route::resource('todo-groups', TodoGroupController::class)
        ->except(['destroy', 'update', 'store'])
        ->names('page.group');
});

// Route::post('/tokens/create', function (Request $request) {

//     $token = $request->user()->createToken($request->token_name);
//     return ['token' => $token->plainTextToken];

// });

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
